<?php

namespace Drupal\perls_api\EntityNormalizer;

use Drupal\Core\Field\Plugin\Field\FieldType\DateTimeItem;
use Drupal\Core\Field\Plugin\Field\FieldType\TimestampItem;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer for a date field into an ISO8601 string.
 */
class DateTimeIso8601Normalizer implements NormalizerInterface {

  /**
   * {@inheritdoc}
   */
  public function normalize($data, $format = NULL, array $context = []) {
    /** @var \Drupal\datetime\Plugin\Field\FieldType\FieldItemInterface $data */
    $date = new DateTime("@" . $data->getValue()['value']);
    return $date->format(DateTimeInterface::ISO8601);
  }

  /**
   * {@inheritdoc}
   */
  public function supportsNormalization($data, $format = NULL) {
    return $data instanceof TimestampItem || $data instanceof DateTimeItem;
  }

}
