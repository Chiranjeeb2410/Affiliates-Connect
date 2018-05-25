<?php

/**
 * @file
 * Contains \Drupal\affiliates_connect\Form\AffiliatesConnectSetttingsForm.
 */

namespace Drupal\affiliates_connect\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Settings form for Affiliates Connect.
 */
class AffiliatesConnectSetttingsForm extends ConfigFormBase
{

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
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      'affiliates_connect.settings'
    ];
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

    $form['affiliates_connect'] = [
      '#type' => 'details',
      '#title' => $this->t('Affiliates Connect Settings'),
      '#open' => TRUE,
    ];

    $form['affiliates_connect']['data_storage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Data Storage'),
      '#description' => $this->t('Enable to store product\'s data in your site\'s database.'),
      '#default_value' => $config->get('data_storage'),
    ];

    $form['affiliates_connect']['fallback_scraper'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Fallback Scraper API'),
      '#description' => $this->t('Enable to use Scraper API if Affiliate API fails to search'),
      '#default_value' => $config->get('fallback_scraper'),
    ];

    $form['affiliates_connect']['save_searched_products'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Save searched products in database'),
      '#description' => $this->t('Enable to save data in database during search if not found in database.'),
      '#default_value' => $config->get('save_searched_products'),
    ];

    $form['affiliates_connect']['cloaking'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Cloaking'),
      '#description' => $this->t('Enable to hide Affiliate IDs in Affiliate URLs.'),
      '#default_value' => $config->get('cloaking'),
    ];

    $form['affiliates_connect']['enable_hits_analysis'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('User hits count and analysis'),
      '#description' => $this->t('Enable to count site visitor hits on cloak urls.'),
      '#default_value' => $config->get('enable_hits_analysis'),
    ];

    $form['affiliates_connect']['append_affiliate_id'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Append Affiliate tracking ID to scraped product\'s URL'),
      '#description' => $this->t('Enable to automatically append affiliate tracking id to products url
      during scraping.'),
      '#default_value' => $config->get('append_affiliate_id'),
    ];

    return parent::buildForm($form, $form_state);

  }

  /**
   * {@inheritdoc}
   */
  // public function validateForm(array $form, FormStateInterface $form_state)
  // {
  //   parent::validateForm($form, $form_state);
  // }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $values = $form_state->getValues();
    $this->config('affiliates_connect.settings')
      ->set('data_storage', $values['data_storage'])
      ->set('fallback_scraper', $values['fallback_scraper'])
      ->set('save_searched_products', $values['save_searched_products'])
      ->set('cloaking', $values['cloaking'])
      ->set('enable_hits_analysis', $values['enable_hits_analysis'])
      ->set('append_affiliate_id', $values['append_affiliate_id'])
      ->save();
    parent::submitForm($form, $form_state);
  }

}

