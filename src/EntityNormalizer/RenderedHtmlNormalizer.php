<?php

namespace Drupal\perls_api\EntityNormalizer;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer to turn an entity into it's rendered form.
 */
class RenderedHtmlNormalizer implements NormalizerInterface {

  /**
   * {@inheritdoc}
   */
  public function normalize($data, $format = NULL, array $context = []) {
    $builder = \Drupal::entityManager()->getViewBuilder($data->getEntityTypeId());
    $render = $builder->view($data);
    return \Drupal::service('renderer')->render($render);
  }

  /**
   * {@inheritdoc}
   */
  public function supportsNormalization($data, $format = NULL) {
    return $data instanceof EntityInterface;
  }

}
