<?php
/**
 * @file
 * Contains \Drupal\mbmc_antropometria\Form\ImcForm.
 */
namespace Drupal\mbmc_antropometria\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class ImcForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'mbmc_antropometria_form';
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
        $peso = 0;
        $altura = 0;
        if ($nodes) {
            foreach ($nodes as $key => $node) {
                if ($node->get('field_peso')->getValue()) {
                    $peso = $node->get('field_peso')->getValue()[0]['value'];
                }

                if ($node->get('field_altura')->getValue()) {
                    $altura = $node->get('field_altura')->getValue()[0]['value'];
                }
            }

        }
        $form['peso'] = array(
            '#type' => 'textfield',
            '#title' => t('Ingrese su peso (KG):'),
            '#required' => true,
            '#default_value' => $peso != '' ? $peso : '',
        );
        $form['estatura'] = array(
            '#type' => 'textfield',
            '#title' => t('Ingrese su estatura (CM):'),
            '#required' => true,
            '#default_value' => $altura != '' ? $altura : '',
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

        $imc = 20;
        if ($datos['peso'] != 0 && $datos['estatura'] != 0) {
            $imc = ($datos['peso'] / ($datos['estatura'] * $datos['estatura'])) * 10000;
            $imc = round($imc, 1);
        }

        if ($imc < 18) {
            $detalle_imc = "Por debajo del peso adecuado";
        } elseif ($imc >= 18 && $imc < 24) {
            $detalle_imc = "Peso Adecuado";
        } elseif ($imc >= 24 && $imc < 27) {
            $detalle_imc = "Sobrepeso";
        } elseif ($imc >= 27 && $imc < 31) {
            $detalle_imc = "Obesidad grado I";
        } elseif ($imc >= 31 && $imc < 35) {
            $detalle_imc = "Obesidad grado II";
        } else {
            $detalle_imc = "Obesidad mórbida";
        }

        if ($nodes) {
            foreach ($nodes as $key => $node) {
                $node->set('title', 'antropometria de ' . $name);
                $node->set('field_altura', $datos['estatura']);
                $node->set('field_peso', $datos['peso']);
                $node->set('field_indice_de_masa_corporal_', $imc);
                $node->set('field_detalle_imc', $detalle_imc);

                $node->save();
                \Drupal::messenger()->addStatus(t('data successfully registered.'));
                sleep(3);
                header('Location: ../user');
                exit;

            }

        } else {

            $node = Node::create(array(
                'type' => 'antropometria',
                'title' => 'antropometria de ' . $name,
                'langcode' => 'es',
                'uid' => $user_id,
                'status' => 1,
                'field_fields' => array(
                    'field_altura' => $datos['estatura'],
                    'field_peso' => $datos['peso'],
                    'field_indice_de_masa_corporal_' => $imc,
                    'field_detalle_imc' => $detalle_imc,
                ),
            ));

            $node->save();

            \Drupal::messenger()->addStatus(t('data successfully registered.'));

            sleep(3);
            header('Location: ../user');
            exit;

        }

    }

}
