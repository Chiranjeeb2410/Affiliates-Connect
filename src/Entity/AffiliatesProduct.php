<?php

namespace Drupal\affiliates_connect\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Affiliates Product entity.
 *
 * @ingroup affiliates_connect
 *
 * @ContentEntityType(
 *   id = "affiliates_product",
 *   label = @Translation("Affiliates Product"),
 *   base_table = "affiliates_product",
 *   entity_keys = {
 *     "id" = "id",
 *     "plugin_id" = "plugin_id",
 *   }
 * )
 */
class AffiliatesProduct extends ContentEntityBase implements ContentEntityInterface {


  /**
   * Returns the Product Name.
   *
   * @return string
   *   Product Name.
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Affiliates Product record.'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    // Name of the affiliates connect plugin associated.
    $fields['plugin_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Plugin ID'))
      ->setDescription(t('Affiliates Connect Plugin ID.'));

    // Name of the product.
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product Name'))
      ->setDescription(t('The name of the product.'));

    // ProductID of the product that is unique.
    $fields['productId'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product ID'))
      ->setDescription(t('The unique productId of the product.'));

    // Description of the product.
    $fields['productDescription'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Product Description'))
      ->setDescription(t('The description of the product.'));

    // Description of the product.
    $fields['imageUrls'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Product Image URLs'))
      ->setDescription(t('The image urls of the product.'));

    // Category of the product.
    $fields['productFamily'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product Category'))
      ->setDescription(t('The category of the product.'));

    // Currency of the product.
    $fields['currency'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Currency'))
      ->setDescription(t('The currency of the product.'));

    // M.R.P of the product.
    $fields['maximumRetailPrice'] = BaseFieldDefinition::create('string')
      ->setLabel(t('M.R.P'))
      ->setDescription(t('The M.R.P of the product.'));

    // Vendor Selling Price of the product.
    $fields['vendorSellingPrice'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Price'))
      ->setDescription(t('The vendor selling price of the product.'));

    // Vendor Special Price of the product.
    $fields['vendorSpecialPrice'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Deal Price'))
      ->setDescription(t('The vendor deal price of the product.'));

    // URL of the product.
    $fields['productUrl'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Product URL'))
      ->setDescription(t('The url of the product.'));

    // Brand of the product.
    $fields['productBrand'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product Brand'))
      ->setDescription(t('The brand of the product.'));

    // Avalability of the product.
    $fields['inStock'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product Avalability'))
      ->setDescription(t('The avalability of the product.'));

    // Cash on devilery of the product.
    $fields['codAvailable'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Cash on Delivery'))
      ->setDescription(t('The avalability of the product COD.'));

    // Discount percentage on the product price.
    $fields['discountPercentage'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Discount (%)'))
      ->setDescription(t('The discount of the product in %.'));

    // Offers on the product.
    $fields['offers'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Offers'))
      ->setDescription(t('The offers on the product.'));

    // Size of the product.
    $fields['size'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Size'))
      ->setDescription(t('The size of the product.'));

    // Color of the product.
    $fields['color'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Color'))
      ->setDescription(t('The color of the product'));

    // Seller Name of the product.
    $fields['sellerName'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Seller Name'))
      ->setDescription(t('The seller name of the product'));

    // Seller Name of the product.
    $fields['sellerAverageRating'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Seller Name'))
      ->setDescription(t('The seller name of the product'));

    // Additional Data collected from affiliare APIs or scraper.
    $fields['additional_data'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Additional data'))
      ->setDescription(t('The additional data kept for future use.'));

    // User creation time.
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    // User modified time.
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
