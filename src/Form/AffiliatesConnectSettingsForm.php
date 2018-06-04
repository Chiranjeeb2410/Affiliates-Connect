<?php

/**
 * @file
 * Contains \Drupal\affiliates_connect\Form\AffiliatesConnectSettingsForm.
 */

namespace Drupal\affiliates_connect\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Creates the AffiliatesConnectSettingsForm class.
 *
 * Creates admin form for saving common system configuration
 * settings to be inherited by the associated subordinate plugins.
 */
class AffiliatesConnectSettingsForm extends ConfigFormBase {

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
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'affiliates_connect.settings'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'affiliates_connect_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('affiliates_connect.settings');

    $form['affiliates_connect'] = [
      '#type' => 'details',
      '#title' => $this->t('Affiliates Connect configuration settings'),
      '#open' => TRUE,
    ];

    $form['affiliates_connect']['data_storage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Data Storage'),
      '#description' => $this->t('Enable to store product\'s data in your site\'s database.'),
      '#default_value' => $config->get('data_storage'),
    ];

    $form['affiliates_connect']['data_storage_form'] = [
      '#type' => 'details',
      '#title' => $this->t('Storage token'),
      '#open' => TRUE,
      '#states' => [
         "visible" => [
           "input[name='data_storage']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['affiliate_import'] = [
      '#type' => 'select',
      '#title' => $this->t('Import period for Affiliate API'),
      '#options' => [
         'every_day' => $this->t('Everyday'),
         'every_15_days' => $this->t('Every 15 days'),
         'every_week' => $this->t('Every week'),
         'every_week' => $this->t('Every month'),
      ],
      '#attributes' => ['class' => ['select-bbq-selector']],
      '#empty_option' => 'Select',
      '#default_value' => $config->get('affiliate_import'),
      '#states' => [
        "required" => [
          "input[name='data_storage']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['scraper_import'] = [
      '#type' => 'select',
      '#title' => $this->t('Import period for Scraper API'),
      '#options' => [
         'every_day' => $this->t('Everyday'),
         'every_15_days' => $this->t('Every 15 days'),
         'every_week' => $this->t('Every week'),
         'every_week' => $this->t('Every month'),
      ],
      '#attributes' => ['class' => ['select-bbq-selector']],
      '#empty_option' => 'Select',
      '#default_value' => $config->get('scraper_import'),
      '#states' => [
         "required" => [
           "input[name='data_storage']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Scrape Content'),
      '#description' => $this->t('Scrape content on a daily basis (Update)'),
      '#default_value' => $config->get('content_scrape'),
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form'] = [
      '#type' => 'details',
      '#title' => $this->t('Content Scrape Token'),
      '#open' => TRUE,
      '#states' => [
         "visible" => [
           "input[name='content_scrape']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['scrape_timer'] = [
      '#type' => 'select',
      '#title' => $this->t('Import period for content scraping'),
      '#options' => [
         'every_30_mins' => $this->t('Every 30 mins'),
         'every_hour' => $this->t('Every 1 hour'),
         'every_2_hours' => $this->t('Every 2 hours'),
         'every_5_hours' => $this->t('Every 5 hours'),
         'every_10_hours' => $this->t('Every 10 hours'),
         'every_15_hours' => $this->t('Every 15 hours'),
         'every_20_hours' => $this->t('Every 20 hours'),
      ],
      '#attributes' => ['class' => ['select-bbq-selector']],
      '#empty_option' => 'Select',
      '#default_value' => $config->get('scrape_timer'),
      '#states' => [
         "required" => [
           "input[name='content_scrape']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['full_content'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Full Content'),
      '#default_value' => $config->get('full_content'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['reviews'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Reviews'),
      '#default_value' => $config->get('reviews'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['available'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Availability'),
      '#default_value' => $config->get('available'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['size'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Size'),
      '#default_value' => $config->get('size'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['color'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Color'),
      '#default_value' => $config->get('color'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['offers'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Offers'),
      '#default_value' => $config->get('offers'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
    ];

    $form['affiliates_connect']['data_storage_form']['content_scrape_form']['others'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Others'),
      '#default_value' => $config->get('others'),
      '#states' => [
         "required" => [
           "input[name='content_scrape_form']" => ["checked" => TRUE]],
      ],
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
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('affiliates_connect.settings')
      ->set('data_storage', $values['data_storage'])
      ->set('affiliate_import', $values['affiliate_import'])
      ->set('scraper_import', $values['scraper_import'])
      ->set('content_scrape', $values['content_scrape'])
      ->set('scrape_timer', $values['scrape_timer'])
      ->set('full_content', $values['full_content'])
      ->set('reviews', $values['reviews'])
      ->set('available', $values['available'])
      ->set('size', $values['size'])
      ->set('color', $values['color'])
      ->set('offers', $values['offers'])
      ->set('others', $values['others'])
      ->set('fallback_scraper', $values['fallback_scraper'])
      ->set('save_searched_products', $values['save_searched_products'])
      ->set('cloaking', $values['cloaking'])
      ->set('enable_hits_analysis', $values['enable_hits_analysis'])
      ->set('append_affiliate_id', $values['append_affiliate_id'])
      ->save();
    parent::submitForm($form, $form_state);
  }

}
