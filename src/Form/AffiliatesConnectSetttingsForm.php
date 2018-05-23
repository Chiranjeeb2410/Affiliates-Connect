<?php
/**
 * @file
 * Contains Drupal\affiliates_connect\Form\AffiliatesConnectSetttingsForm.
 */

namespace Drupal\affiliates_connect\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Routing\RouteProviderInterface;

/**
 * Settings form for Affiliates Connect.
 */
class AffiliatesConnectSettingsForm extends ConfigFormBase
{
  /**
   * Constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   * @param \Drupal\Core\Routing\RouteProviderInterface $route_provider
   *   Used to check if route exists.
   * @param \Drupal\Core\Path\PathValidatorInterface $path_validator
   *   Used to check if path is valid and exists.
   */
  public function __construct(ConfigFactoryInterface $config_factory, RouteProviderInterface $route_provider, PathValidatorInterface $path_validator, RequestContext $request_context)
  {
    parent::__construct($config_factory, $route_provider, $path_validator);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('config.factory'),
      $container->get('router.route_provider'),
      $container->get('path.validator'),
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return array_merge(
      parent::getEditableConfigNames(),
      ['affiliates_connect.settings']
      );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'affiliates_connect_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('affiliates_connect.settings');

    // $form[] = [
    //  fields to be defined
    // ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array $form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $values = $form_state->getValues();
    $this->config('affiliates_connect.settings')
      ->set('message', $values['message'])
      ->save();
    parent::submitForm($form, $form_state);
  }
}

