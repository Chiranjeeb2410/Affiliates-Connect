<?php

namespace Drupal\affiliates_connect_amazon\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\affiliates_connect\Form\AffiliatesConnectSetttingsForm;

/**
 * Class AffiliatesAmazonSettingsForm.
 */
class AffiliatesAmazonSettingsForm extends AffiliatesConnectSetttingsForm {


  /**
   * Constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this class.
    return new static(
    // Load the services required to construct this class.
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'affiliates_connect_amazon_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return array_merge(
      parent::getEditableConfigNames(),
      ['affiliates_connect_amazon.settings']
    );
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('affiliates_connect_amazon.settings');

    $form['amazon_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Affiliates Connect Amazon Settings'),
      '#open' => TRUE,
      '#description' => $this->t('You need to first create Amazon Associates at <a href="@amazon-affiliate-marketing">@amazon-affiliate-marketing</a>', ['@amazon-affiliate-marketing' => 'https://affiliate-program.amazon.in/']),
    ];

    $form['amazon_settings']['native_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Native API'),
      '#description' => $this->t('Enable to use Affiliate Marketing using tracking ID'),
      '#default_value' => $config->get('native_api'),
    ];

    $form['amazon_settings']['native_api_form'] = [
      '#type' => 'details',
      '#title' => $this->t('API Token'),
      '#open' => TRUE,
      '#states' => [
        "visible" => [
          "input[name='native_api']" => ["checked" => TRUE]],
      ],
    ];

    $form['amazon_settings']['native_api_form']['native_affiliate_id'] = [
      '#type' => 'textfield',
      '#title' => t('Affiliate Tracking ID'),
      '#default_value' => '',
      '#size' => 60,
      '#maxlength' => 60,
      '#states' => [
        "required" => [
          "input[name='native_api']" => ["checked" => TRUE]],
      ],
      '#machine_name' => [
        'exists' => [
          $this,
          'exists',
        ],
      ],
    ];

    $form['amazon_settings']['native_api_form']['native_affiliate_token'] = [
      '#type' => 'textfield',
      '#title' => t('Affiliate Tracking Token'),
      '#default_value' => '',
      '#size' => 60,
      '#maxlength' => 60,
      '#states' => [
        "required" => [
          "input[name='native_api']" => ["checked" => TRUE]],
      ],
      '#machine_name' => [
        'exists' => [
          $this,
          'exists',
        ],
      ],
    ];

    $form['amazon_settings']['scraper_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Scraper API'),
      '#description' => $this->t('Enable to use Scraper API to overcome limitation of Affiliate API'),
      '#default_value' => $config->get('scraper_api'),
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $this->config('affiliates_connect_amazon.settings')
      ->set('native_api', $values['native_api'])
      ->set('native_affiliate_id', $values['native_affiliate_id'])
      ->set('native_affiliate_token', $values['native_affiliate_token'])
      ->set('scraper_api', $values['scraper_api'])
      ->save();
    parent::submitForm($form, $form_state);
  }

}
