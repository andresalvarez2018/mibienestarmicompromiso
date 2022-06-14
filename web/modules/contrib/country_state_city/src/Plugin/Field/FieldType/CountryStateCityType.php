<?php

namespace Drupal\country_state_city\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'country_state_city_type' field type.
 *
 * @FieldType(
 *   id = "country_state_city_type",
 *   label = @Translation("Country state city type"),
 *   description = @Translation("Country ,state and city plugin"),
 *   default_widget = "country_state_city_widget",
 *   default_formatter = "contry_state_city_formatter"
 * )
 */
class CountryStateCityType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'is_ascii' => FALSE,
      'case_sensitive' => FALSE,
      'country_lable' => '',
      'state_lable' => '',
      'city_lable' => '',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['country'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Country'))
      ->setRequired(FALSE);

    $properties['state'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('State'))
      ->setRequired(FALSE);

    $properties['city'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('City'))
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
        'state' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'city' => [
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
    $elements['state_lable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for state'),
      '#description' => $this->t('Override default label of state'),
      '#default_value' => $this->getSetting('state_lable'),
      '#attributes' => [
        'placeholder' => $this->t('Enter field label'),
      ],
    ];
    $elements['city_lable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for city'),
      '#description' => $this->t('Override default label of city'),
      '#default_value' => $this->getSetting('city_lable'),
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
    $state = empty($this->get('state')->getValue());
    $city = empty($this->get('city')->getValue());

    return $country||$state||$city;
  }

}
