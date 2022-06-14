<?php

namespace Drupal\country_state_city;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Slider entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 * @ingroup country_state_city
 */
interface StateListInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
