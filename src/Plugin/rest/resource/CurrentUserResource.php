<?php

namespace Drupal\perls_api\Plugin\rest\resource;

use Drupal\user\Entity\User;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a resource to get the currently authenticated user.
 *
 * @RestResource(
 *   id = "current_user_resource",
 *   label = @Translation("Current User Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/user/me"
 *   }
 * )
 */
class CurrentUserResource extends ResourceBase {

  /**
   * Gets the current user.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The current user entity.
   */
  public function get() {
    $user = User::load(\Drupal::currentUser()->id());
    $response = new ResourceResponse($user);
    $response->addCacheableDependency($user);
    $response->getCacheableMetadata()->addCacheContexts(['user']);
    return $response;
  }

}
