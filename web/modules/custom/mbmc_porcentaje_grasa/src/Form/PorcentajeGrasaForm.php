<?php

namespace Drupal\mbmc_porcentaje_grasa\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Class PorcentajeGrasaForm.
 */
class PorcentajeGrasaForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'porcentaje_grasa_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $user_id = \Drupal::currentUser()->id();
        $account = \Drupal\user\Entity\User::load($user_id);
        $genero = $account->get('field_gender')->getValue()[0]['value'];

        $hoy = date("Y-m-d H:i:s");
        $nacimiento = $account->get('field_date_birthday')->getValue()[0]['value'];

        $nodes = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadByProperties([
                'type' => 'porcentaje_grasa',
                'uid' => $user_id,
            ]);
        $cintura = '';
        $cadera = '';
        $estatura = '';
        $cuello = '';

        if ($nodes) {
            foreach ($nodes as $key => $node) {
                if ($node->get('field_cintura_grasa')->getValue()) {
                    $cintura = $node->get('field_cintura_grasa')->getValue()[0]['value'];
                }

                if ($node->get('field_cadera_grasa')->getValue()) {
                    $cadera = $node->get('field_cadera_grasa')->getValue()[0]['value'];
                }

                if ($node->get('field_estatura')->getValue()) {
                    $estatura = $node->get('field_estatura')->getValue()[0]['value'];
                }

                if ($node->get('field_cuello')->getValue()) {
                    $cuello = $node->get('field_cuello')->getValue()[0]['value'];
                }

            }

        }

        if ($genero == "masculino") {

            $form['cintura'] = array(
                '#type' => 'number',
                '#title' => t('Medida de la cintura (cm)'),
                '#required' => true,
                '#default_value' => $cintura != '' ? $cintura : '',
            );

            $form['cuello'] = array(
                '#type' => 'number',
                '#title' => t('Medida del cuello (cm)'),
                '#required' => true,
                '#default_value' => $cuello != '' ? $cuello : '',
            );

            $form['estatura'] = array(
                '#type' => 'number',
                '#title' => t('Estatura (cm)'),
                '#required' => true,
                '#default_value' => $estatura != '' ? $estatura : '',
            );

        } else {
            $form['cintura'] = array(
                '#type' => 'number',
                '#title' => t('Medida de la cintura (cm)'),
                '#required' => true,
                '#default_value' => $cintura != '' ? $cintura : '',
            );

            $form['cuello'] = array(
                '#type' => 'number',
                '#title' => t('Medida del cuello (cm)'),
                '#required' => true,
                '#default_value' => $cuello != '' ? $cuello : '',
            );

            $form['estatura'] = array(
                '#type' => 'number',
                '#title' => t('Estatura (cm)'),
                '#required' => true,
                '#default_value' => $estatura != '' ? $estatura : '',
            );

            $form['cadera'] = array(
                '#type' => 'number',
                '#title' => t('Cadera (cm)'),
                '#required' => true,
                '#default_value' => $cadera != '' ? $cadera : '',
            );

        }

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Guardar'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        foreach ($form_state->getValues() as $key => $value) {
            $datos[$key] = $value;
        }

        $user_id = \Drupal::currentUser()->id();
        $usuario_actual = \Drupal::currentUser();
        $name = $usuario_actual->getAccount()->name;

        $account = \Drupal\user\Entity\User::load($user_id);
        $genero = $account->get('field_gender')->getValue()[0]['value'];
        $hoy = date("Y-m-d H:i:s");
        $nacimiento = $account->get('field_date_birthday')->getValue()[0]['value'];
        $edad = $hoy - $nacimiento;

        $nodes = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadByProperties([
                'type' => 'porcentaje_grasa',
                'uid' => $user_id,
            ]);

        $cintura = round($datos['cintura'] / 2.54, 2);
        $cuello = round($datos['cuello'] / 2.54, 2);
        $estatura = round($datos['estatura'] / 2.54, 2);
        $cadera = 0;
        if (isset($datos['cadera'])) {
            $cadera = round($datos['cadera'] / 2.54, 2);
        }
        $estado = '';
        if ($nodes) {
            if ($genero == "masculino") {
                foreach ($nodes as $key => $node) {
                    $step1 = (86.010 * log($cintura - $cuello, 10)); //118.1
                    $step2 = (70.041 * log($estatura, 10)); //129.6
                    $grasa = $step1 - $step2 + 36.76;
                    $grasa = round($grasa, 2);

                    if ($edad >= 20 && $edad <= 29) {
                        if ($grasa < 11) {
                            $estado = "atleta";
                        } elseif ($grasa > 11 && $grasa < 13) {
                            $estado = "optimo";
                        } elseif ($grasa > 14 && $grasa < 20) {
                            $estado = "adecuado";
                        } elseif ($grasa > 21 && $grasa < 23) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 23) {
                            $estado = "obesidad";
                        }
                    } elseif ($edad >= 30 && $edad <= 39) {
                        if ($grasa < 12) {
                            $estado = "atleta";
                        } elseif ($grasa > 12 && $grasa < 14) {
                            $estado = "optimo";
                        } elseif ($grasa > 15 && $grasa < 21) {
                            $estado = "adecuado";
                        } elseif ($grasa > 22 && $grasa < 24) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 24) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 40 && $edad <= 49) {
                        if ($grasa < 14) {
                            $estado = "atleta";
                        } elseif ($grasa > 14 && $grasa < 16) {
                            $estado = "optimo";
                        } elseif ($grasa > 17 && $grasa < 23) {
                            $estado = "adecuado";
                        } elseif ($grasa > 24 && $grasa < 26) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 26) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 50 && $edad <= 59) {
                        if ($grasa < 15) {
                            $estado = "atleta";
                        } elseif ($grasa > 16 && $grasa < 17) {
                            $estado = "optimo";
                        } elseif ($grasa > 18 && $grasa < 24) {
                            $estado = "adecuado";
                        } elseif ($grasa > 25 && $grasa < 27) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 27) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 60) {
                        if ($grasa < 16) {
                            $estado = "atleta";
                        } elseif ($grasa > 16 && $grasa < 18) {
                            $estado = "optimo";
                        } elseif ($grasa > 18 && $grasa < 25) {
                            $estado = "adecuado";
                        } elseif ($grasa > 26 && $grasa < 28) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 29) {
                            $estado = "obesidad";
                        }
                    }

                    $node->set('title', 'porcentaje de  grasas ' . $name);
                    $node->set('field_cintura_grasa', $datos['cintura']);
                    $node->set('field_cuello', $datos['cuello']);
                    $node->set('field_estatura', $datos['estatura']);
                    $node->set('field_porcentaje_', $grasa);
                    $node->set('field_estado', $estado);
                    $node->save();
                    \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

                    header('Location: /web/user/' . $user_id);
                    exit;

                }
            } else {
                foreach ($nodes as $key => $node) {
                    $step1 = (163.205 * log($cintura + $cadera - $cuello, 10)); //118.1
                    $step2 = (97.684 * log($estatura, 10)); //129.6
                    $grasa = $step1 - $step2 - 78.387;
                    $grasa = round($grasa, 2);

                    if ($edad >= 20 && $edad <= 29) {
                        if ($grasa < 16) {
                            $estado = "atleta";
                        } elseif ($grasa > 16 && $grasa < 19) {
                            $estado = "optimo";
                        } elseif ($grasa > 20 && $grasa < 28) {
                            $estado = "adecuado";
                        } elseif ($grasa > 29 && $grasa < 31) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 31) {
                            $estado = "obesidad";
                        }
                    } elseif ($edad >= 30 && $edad <= 39) {
                        if ($grasa < 17) {
                            $estado = "atleta";
                        } elseif ($grasa > 17 && $grasa < 20) {
                            $estado = "optimo";
                        } elseif ($grasa > 21 && $grasa < 29) {
                            $estado = "adecuado";
                        } elseif ($grasa > 30 && $grasa < 32) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 32) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 40 && $edad <= 49) {
                        if ($grasa < 18) {
                            $estado = "atleta";
                        } elseif ($grasa > 18 && $grasa < 21) {
                            $estado = "optimo";
                        } elseif ($grasa > 22 && $grasa < 30) {
                            $estado = "adecuado";
                        } elseif ($grasa > 31 && $grasa < 33) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 33) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 50 && $edad <= 59) {
                        if ($grasa < 19) {
                            $estado = "atleta";
                        } elseif ($grasa > 19 && $grasa < 22) {
                            $estado = "optimo";
                        } elseif ($grasa > 23 && $grasa < 31) {
                            $estado = "adecuado";
                        } elseif ($grasa > 32 && $grasa < 34) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 34) {
                            $estado = "obesidad";
                        }

                    } elseif ($edad >= 60) {
                        if ($grasa < 20) {
                            $estado = "atleta";
                        } elseif ($grasa > 20 && $grasa < 23) {
                            $estado = "optimo";
                        } elseif ($grasa > 24 && $grasa < 32) {
                            $estado = "adecuado";
                        } elseif ($grasa > 35 && $grasa < 36) {
                            $estado = "sobrepeso";
                        } elseif ($grasa > 36) {
                            $estado = "obesidad";
                        }
                    }

                    $node->set('title', 'Porcentaje de  grasas de' . $name);
                    $node->set('field_cintura_grasa', $datos['cintura']);
                    $node->set('field_cuello', $datos['cuello']);
                    $node->set('field_estatura', $datos['estatura']);
                    $node->set('field_cadera_grasa', $datos['cadera']);
                    $node->set('field_porcentaje_', $grasa);
                    $node->set('field_estado', $estado);
                    $node->save();
                    \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

                    header('Location: /web/user/' . $user_id);
                    exit;

                }

            }

        } else {
            if ($genero == "masculino") {
                $step1 = (86.010 * log($cintura - $cuello, 10)); //118.1
                $step2 = (70.041 * log($estatura, 10)); //129.6
                $grasa = $step1 - $step2 + 36.76;
                $grasa = round($grasa, 2);

                if ($edad >= 20 && $edad <= 29) {
                    if ($grasa < 11) {
                        $estado = "atleta";
                    } elseif ($grasa > 11 && $grasa < 13) {
                        $estado = "optimo";
                    } elseif ($grasa > 14 && $grasa < 20) {
                        $estado = "adecuado";
                    } elseif ($grasa > 21 && $grasa < 23) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 23) {
                        $estado = "obesidad";
                    }
                } elseif ($edad >= 30 && $edad <= 39) {
                    if ($grasa < 12) {
                        $estado = "atleta";
                    } elseif ($grasa > 12 && $grasa < 14) {
                        $estado = "optimo";
                    } elseif ($grasa > 15 && $grasa < 21) {
                        $estado = "adecuado";
                    } elseif ($grasa > 22 && $grasa < 24) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 24) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 40 && $edad <= 49) {
                    if ($grasa < 14) {
                        $estado = "atleta";
                    } elseif ($grasa > 14 && $grasa < 16) {
                        $estado = "optimo";
                    } elseif ($grasa > 17 && $grasa < 23) {
                        $estado = "adecuado";
                    } elseif ($grasa > 24 && $grasa < 26) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 26) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 50 && $edad <= 59) {
                    if ($grasa < 15) {
                        $estado = "atleta";
                    } elseif ($grasa > 16 && $grasa < 17) {
                        $estado = "optimo";
                    } elseif ($grasa > 18 && $grasa < 24) {
                        $estado = "adecuado";
                    } elseif ($grasa > 25 && $grasa < 27) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 27) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 60) {
                    if ($grasa < 16) {
                        $estado = "atleta";
                    } elseif ($grasa > 16 && $grasa < 18) {
                        $estado = "optimo";
                    } elseif ($grasa > 18 && $grasa < 25) {
                        $estado = "adecuado";
                    } elseif ($grasa > 26 && $grasa < 28) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 29) {
                        $estado = "obesidad";
                    }
                }

                $node = Node::create(['type' => 'porcentaje_grasa']);
                $node->title = 'Porcentaje de  grasas de' . $name;
                $node->uid = $user_id;
                $node->field_cintura_grasa = $datos['cintura'];
                $node->field_cuello = $datos['cuello'];
                $node->field_estatura = $datos['estatura'];
                $node->field_porcentaje_ = $grasa;
                $node->field_estado = $estado;

                $node->save();

                \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

                header('Location: /web/user/' . $user_id);
                exit;

            } else {
                $step1 = (163.205 * log($cintura + $cadera - $cuello, 10)); //118.1
                $step2 = (97.684 * log($estatura, 10)); //129.6
                $grasa = $step1 - $step2 - 78.387;
                $grasa = round($grasa, 2);

                if ($edad >= 20 && $edad <= 29) {
                    if ($grasa < 16) {
                        $estado = "atleta";
                    } elseif ($grasa > 16 && $grasa < 19) {
                        $estado = "optimo";
                    } elseif ($grasa > 20 && $grasa < 28) {
                        $estado = "adecuado";
                    } elseif ($grasa > 29 && $grasa < 31) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 31) {
                        $estado = "obesidad";
                    }
                } elseif ($edad >= 30 && $edad <= 39) {
                    if ($grasa < 17) {
                        $estado = "atleta";
                    } elseif ($grasa > 17 && $grasa < 20) {
                        $estado = "optimo";
                    } elseif ($grasa > 21 && $grasa < 29) {
                        $estado = "adecuado";
                    } elseif ($grasa > 30 && $grasa < 32) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 32) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 40 && $edad <= 49) {
                    if ($grasa < 18) {
                        $estado = "atleta";
                    } elseif ($grasa > 18 && $grasa < 21) {
                        $estado = "optimo";
                    } elseif ($grasa > 22 && $grasa < 30) {
                        $estado = "adecuado";
                    } elseif ($grasa > 31 && $grasa < 33) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 33) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 50 && $edad <= 59) {
                    if ($grasa < 19) {
                        $estado = "atleta";
                    } elseif ($grasa > 19 && $grasa < 22) {
                        $estado = "optimo";
                    } elseif ($grasa > 23 && $grasa < 31) {
                        $estado = "adecuado";
                    } elseif ($grasa > 32 && $grasa < 34) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 34) {
                        $estado = "obesidad";
                    }

                } elseif ($edad >= 60) {
                    if ($grasa < 20) {
                        $estado = "atleta";
                    } elseif ($grasa > 20 && $grasa < 23) {
                        $estado = "optimo";
                    } elseif ($grasa > 24 && $grasa < 32) {
                        $estado = "adecuado";
                    } elseif ($grasa > 35 && $grasa < 36) {
                        $estado = "sobrepeso";
                    } elseif ($grasa > 36) {
                        $estado = "obesidad";
                    }
                }

                $node = Node::create(['type' => 'porcentaje_grasa']);
                $node->title = 'Porcentaje de  grasas de' . $name;
                $node->uid = $user_id;
                $node->field_cintura_grasa = $datos['cintura'];
                $node->field_cuello = $datos['cuello'];
                $node->field_estatura = $datos['estatura'];
                $node->field_cadera_grasa = $datos['cadera'];
                $node->field_porcentaje_ = $grasa;
                $node->field_estado = $estado;

                $node->save();

                \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

                header('Location: /web/user/' . $user_id);
                exit;

            }
        }
    }

}
