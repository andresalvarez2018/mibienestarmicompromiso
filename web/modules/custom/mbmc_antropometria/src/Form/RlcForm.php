<?php
/**
 * @file
 * Contains \Drupal\mbmc_antropometria\Form\ImcForm.
 */
namespace Drupal\mbmc_antropometria\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class RlcForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'rlc_antropometria_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $user_id = \Drupal::currentUser()->id();

        $nodes = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadByProperties([
                'type' => 'antropometria',
                'uid' => $user_id,
            ]);

        $cintura = 0;
        $cadera = 0;
        if ($nodes) {
            foreach ($nodes as $key => $node) {
                if ($node->get('field_cintura')->getValue()) {
                    $cintura = $node->get('field_cintura')->getValue()[0]['value'];
                }

                if ($node->get('field_cadera')->getValue()) {
                    $cadera = $node->get('field_cadera')->getValue()[0]['value'];
                }
            }

        }

        $form['cintura'] = array(
            '#type' => 'textfield',
            '#title' => t('Medir la circunferencia de la cintura (2 dedos por encima del ombligo) cm:'),
            '#required' => true,
            '#default_value' => $cintura != '' ? $cintura : '',
        );

        $form['cadera'] = array(
            '#type' => 'textfield',
            '#title' => t('Medir la circunferencia de la cadera (mide la parte más ancha de la cadera) cm:'),
            '#required' => true,
            '#default_value' => $cadera != '' ? $cadera : '',
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Register'),
            '#button_type' => 'primary',
        );

        return $form;

    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        foreach ($form_state->getValues() as $key => $value) {
            $datos[$key] = $value;

        }

        $user_id = \Drupal::currentUser()->id();
        $usuario_actual = \Drupal::currentUser();
        $name = $usuario_actual->getAccount()->name;

        $nodes = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadByProperties([
                'type' => 'antropometria',
                'uid' => $user_id,
            ]);

        $rlc = 0;
        if ($datos['cintura'] != 0 && $datos['cadera'] != 0) {
            $rlc = $datos['cintura'] / $datos['cadera'];
            $rlc = round($rlc, 2);
        }
        $user_complete = \Drupal::entityTypeManager()->getStorage('user')->load($user_id);

        $genero = $user_complete->get('field_gender')->getValue()[0]['value'];
        if ($genero == "masculino") {
            if ($rlc < 0.82) {
                $detalle_rlc = "Riesgo bajo";
            } elseif ($rlc >= 0.82 && $rlc < 0.88) {
                $detalle_rlc = "Riesgo moderado";
            } elseif ($rlc >= 0.88 && $rlc < 0.94) {
                $detalle_rlc = "Riesgo alto";
            } else {
                $detalle_rlc = "Riesgo muy alto";
            }
        } else {
            if ($rlc < 0.71) {
                $detalle_rlc = "Riesgo bajo";
            } elseif ($rlc >= 0.71 && $rlc < 0.79) {
                $detalle_rlc = "Riesgo moderado";
            } elseif ($rlc >= 0.79 && $rlc < 0.84) {
                $detalle_rlc = "Riesgo alto";
            } else {
                $detalle_rlc = "Riesgo muy alto";
            }
        }

        $datos['detalle_rlc'] = $detalle_rlc;
        $datos['rlc'] = $rlc;

        if ($nodes) {
            foreach ($nodes as $key => $node) {
                $node->set('title', 'Antropometria de ' . $name);
                $node->set('field_cintura', $datos['cintura']);
                $node->set('field_cadera', $datos['cadera']);
                $node->set('field_relacion_cintura_cadera', $rlc);
                $node->set('field_detalle_rlc', $detalle_rlc);

                $node->save();
                \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

                header('Location: /web/user/' . $user_id);
                exit;

            }

        } else {

            $node = Node::create(['type' => 'antropometria']);
            $node->title = 'Antropometria de' . $name;
            $node->uid = $user_id;
            $node->field_cintura = $datos['cintura'];
            $node->field_cadera = $datos['cadera'];
            $node->field_relacion_cintura_cadera = $datos['rlc'];
            $node->field_detalle_rlc = $datos['detalle_rlc'];
            $node->save();

            \Drupal::messenger()->addStatus(t('Datos registrados exitosamente.'));

            header('Location: /web/user/' . $user_id);
            exit;

        }

    }
}
