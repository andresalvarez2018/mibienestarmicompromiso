<?php

namespace Drupal\country_state_city\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'country_type' field type.
 *
 * @FieldType(
 *   id = "country_type",
 *   label = @Translation("Country only"),
 *   description = @Translation("Country plugin"),
 *   default_widget = "country_widget",
 *   default_formatter = "country_formatter"
 * )
 */
class CountryType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'is_ascii' => FALSE,
      'case_sensitive' => FALSE,
      'country_lable' => '',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['country'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Country'))
      ->setRequired(FALSE);

    $properties['locate'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Locate'))
      ->setRequired(FALSE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'country' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $values = [];

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $elements = [];
    $elements['country_lable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for country'),
      '#description' => $this->t('Override default label of country'),
      '#default_value' => $this->getSetting('country_lable'),
      '#attributes' => [
        'placeholder' => $this->t('Enter field label'),
      ],
    ];
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $country = empty($this->get('country')->getValue());

    return $country;
  }

}
