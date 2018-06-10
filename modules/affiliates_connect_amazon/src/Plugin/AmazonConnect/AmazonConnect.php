<?php

namespace Drupal\affiliates_connect_amazon\Plugin\AffiliatesNetwork;

use Drupal\affiliates_connect\AffiliatesNetworkInterface;


/**
 * @AmazonConnect(
 *  id = "affiliates_connect_amazon",
 *  label = @Translation("Amazon"),
 *  description = @Translation("Plugin provided by affiliates_connect_amazon."),
 * )
 */
class AmazonConnect implements  AffiliatesNetworkInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getPluginId() {
    // Gets the plugin_id of the plugin instance.
  }

  /**
   * {@inheritdoc}
   */
  public function getPluginDefinition() {
    // Gets the definition of the plugin implementation.
  }

}
