<?php

namespace Drupal\country_state_city\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'country_widget' widget.
 *
 * @FieldWidget(
 *   id = "country_widget",
 *   label = @Translation("Country widget"),
 *   field_types = {
 *     "country_type"
 *   }
 * )
 */
class CountryWidget extends WidgetBase implements ContainerFactoryPluginInterface {

  /**
   * File storage for files.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Construct a MyFormatter object.
   *
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   Defines an interface for entity field definitions.
   * @param array $settings
   *   The formatter settings.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity type manager service.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);

    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['third_party_settings'],
      // Add any services you want to inject here.
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [] + parent::defaultSettings();
  }

  /**
   * Gets the initial values for the widget.
   *
   * This is a replacement for the disabled default values functionality.
   *
   * @return array
   *   The initial values, keyed by property.
   */
  protected function getInitialValues() {
    $initial_values = [
      'country' => '',
    ];

    return $initial_values;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $item = $items[$delta];
    $value = $item->getEntity()->isNew() ? $this->getInitialValues() : $item->toArray();

    $field_name = $this->fieldDefinition->getName();
    if (isset($form_state->getUserInput()[$field_name])) {
      $country_id = $form_state->getUserInput()[$field_name][$delta]['country'];
    }

    $country_id = $country_id ?? $value['country'] ?? NULL;

    $query = $this->entityTypeManager->getStorage('countrylist')->getQuery()
      ->sort('name', 'asc');

    $ids = $query->execute();

    $countries = [];
    if (count($ids) == 1) {
      $result = $this->entityTypeManager->getStorage('countrylist')->load(key($ids));
      $countries[$result->id()] = $result->getName();
    }
    elseif (count($ids) > 1) {
      $results = $this->entityTypeManager->getStorage('countrylist')->loadMultiple($ids);
      foreach ($results as $result) {
        $countries[$result->id()] = $result->getName();
      }
    }

    $div_id = 'state-wrapper-' . $field_name . '-' . $delta;
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += [
        '#type' => 'fieldset',
        '#attributes' => ['id' => $div_id],
      ];
    }
    $element['#attached']['library'][] = 'country_state_city/country_state_city.search_option';
    $element['country'] = [
      '#type' => 'select',
      '#options' => $countries,
      '#default_value' => $country_id,
      '#empty_option' => $this->t('-- Select an option --'),
      '#required' => $this->fieldDefinition->isRequired(),
      '#title' => !empty($this->getFieldSetting('country_lable')) ? $this->getFieldSetting('country_lable') : $this->t('Country'),
      '#delta' => $delta,
      '#attributes' => [
        'class' => [
          'csc-country-details',
        ],
      ],
    ];

    return $element;
  }

}
