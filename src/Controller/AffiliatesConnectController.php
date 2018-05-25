<?php

namespace Drupal\affiliates_connect\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\affiliates_connect\Plugin\AffiliatesNetworkManager;

/**
 * Renders plugins of affiliates connect.
 */
class AffiliatesConnectController extends ControllerBase {
  /**
   * The affiliates network manager.
   *
   * @var \Drupal\affiliates_connect\Plugin\AffiliatesNetworkManager
   */
  private $affiliatesNetworkManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('plugin.manager.affiliates_network'));
  }

  /**
   * AffiliatesConnectController constructor.
   *
   * @param \Drupal\affiliates_connect\Plugin\AffiliatesNetworkManager $affiliatesNetworkManager
   *   The affiliates network manager.
   */
  public function __construct(AffiliatesNetworkManager $affiliatesNetworkManager) {
    $this->affiliatesNetworkManager = $affiliatesNetworkManager;
  }

  /**
   * Render the list of plugins for a affiliates network.
   *
   * @return array
   *   Render array listing the integrations.
   */
  public function plugins() {
    $networks = $this->affiliatesNetworkManager->getDefinitions();
    $header = [
      $this->t('Module'),
      $this->t('Fetcher Status'),
      $this->t('Operations'),
    ];
    $data = [];
    foreach ($networks as $network) {
      $data[] = [
        $network['label'],
        [
          '#type' => 'markup',
          '#markup' => $this->t('Cron run complete'),
        ],
      ];
    }
    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $data,
      '#empty' => $this->t('There are no plugins enabled.'),
    ];
  }

}
