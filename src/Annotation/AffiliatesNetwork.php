<?php

namespace Drupal\affiliates_connect\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Affiliates network item annotation object.
 *
 * @see \Drupal\affiliates_connect\Plugin\AffiliatesNetworkManager
 * @see plugin_api
 *
 * @Annotation
 */
class AffiliatesNetwork extends Plugin {


  /**
   * The module machine name.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the module.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The description of the module.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
