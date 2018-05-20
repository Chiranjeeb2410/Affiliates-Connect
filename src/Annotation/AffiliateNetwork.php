<?php

namespace Drupal\affiliates_connect\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Affiliate network item annotation object.
 *
 * @see \Drupal\affiliates_connect\Plugin\AffiliateNetworkManager
 * @see plugin_api
 *
 * @Annotation
 */
class AffiliateNetwork extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
