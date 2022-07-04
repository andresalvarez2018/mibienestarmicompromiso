<?php

namespace Drupal\Tests\media_entity_lottie\Functional\Formatter;

use Drupal\Core\Entity\Entity\EntityViewDisplay;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;
use Drupal\Tests\media\Functional\MediaFunctionalTestBase;

/**
 * @coversDefaultClass \Drupal\media_entity_lottie\Plugin\Field\FieldFormatter\FileLottiePlayerFormatter
 * @group file
 */
class FileLottiePlayerFormatterTest extends MediaFunctionalTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'media_entity_lottie',
  ];

  /**
   * The fixtures directory.
   *
   * @var string
   */
  protected $fixturesDirectory;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Enable the canonical URL.
    \Drupal::configFactory()
      ->getEditable('media.settings')
      ->set('standalone_url', TRUE)
      ->save(TRUE);
    $this->container->get('router.builder')->rebuild();

    // Get the fixtures directory.
    $this->fixturesDirectory = drupal_get_path('module', 'media_entity_lottie') . '/tests/fixtures';
  }

  /**
   * Creates a new lottie media bundle.
   *
   * @param string $formatter
   *   The formatter ID.
   * @param array $values
   *   Additional values for the media type entity.
   * @param array $formatter_settings
   *   Settings for the formatter.
   *
   * @return \Drupal\media\MediaTypeInterface
   *   A lottie media type.
   */
  protected function createLottieMedia($formatter, array $values, array $formatter_settings = []) {

    // Create a new lottie media type.
    $media_type = $this->createMediaType('lottie_file', $values);

    $source = $media_type->getSource();
    $source_field = $source->getSourceFieldDefinition($media_type);

    EntityViewDisplay::create([
      'targetEntityType' => 'media',
      'bundle' => $media_type->id(),
      'mode' => 'full',
      'status' => TRUE,
    ])->removeComponent('thumbnail')
      ->setComponent($source_field->getName(), [
        'type' => $formatter,
        'settings' => $formatter_settings,
      ])
      ->save();

    // Assert that the media type has the expected values before proceeding.
    $this->drupalGet('admin/structure/media/manage/' . $media_type->id());
    $this->assertSession()->fieldValueEquals('label', $media_type->label());
    $this->assertSession()->fieldValueEquals('source', 'lottie_file');

    return $media_type;
  }

  /**
   * @covers ::viewElements
   */
  public function testRender() {

    $media_type = $this->createLottieMedia('file_lottie_player',
      [
        'id' => 'lottie',
        'label' => 'Lottie',
      ]
    );

    // Create a new file with the lottie animation.
    $file = File::create([
      'uri' => $this->fixturesDirectory . '/animation.json',
      'filename' => 'animation.json',
    ]);
    $file->save();

    // Create a new lottie media with the lottie animation.
    $source_field = $media_type->getSource()->getSourceFieldDefinition($media_type);
    $media = Media::create([
      'bundle' => $media_type->id(),
      'name' => 'Animation',
      $source_field->getName() => [
        [
          'target_id' => $file->id(),
        ],
      ],
    ]);
    $media->save();

    $this->drupalGet($media->toUrl());

    $file_url = $file->createFileUrl();

    $assert_session = $this->assertSession();
    $assert_session->elementsCount('css', 'lottie-player', 1);
    $assert_session->elementExists('css', "lottie-player[src='$file_url']");
  }

  /**
   * Tests that the attributes added to the formatter are applied on render.
   */
  public function testAttributes() {

    $media_type = $this->createLottieMedia('file_lottie_player',
      [
        'id' => 'lottie',
        'label' => 'Lottie',
      ],
      [
        'background' => '#7fffd4',
        'hover' => TRUE,
        'mode' => 'bounce',
        'speed' => 2,
        'count' => 1,
      ]
    );

    // Create a new file with the lottie animation.
    $file = File::create([
      'uri' => $this->fixturesDirectory . '/animation.json',
      'filename' => 'animation.json',
    ]);
    $file->save();

    // Create a new lottie media with the lottie animation.
    $source_field = $media_type->getSource()->getSourceFieldDefinition($media_type);
    $media = Media::create([
      'bundle' => $media_type->id(),
      'name' => 'Animation',
      $source_field->getName() => [
        [
          'target_id' => $file->id(),
        ],
      ],
    ]);
    $media->save();

    $this->drupalGet($media->toUrl());

    $file_url = $file->createFileUrl();

    $assert_session = $this->assertSession();
    $assert_session->elementExists('css', "lottie-player[background='#7fffd4'][src='$file_url']");
    $assert_session->elementExists('css', "lottie-player[hover][src='$file_url']");
    $assert_session->elementExists('css', "lottie-player[mode='bounce'][src='$file_url']");
    $assert_session->elementExists('css', "lottie-player[speed='2'][src='$file_url']");
    $assert_session->elementExists('css', "lottie-player[count='1'][src='$file_url']");
  }

}
