<?php
/**
 *
 * @category Sashas
 * @package Sashas_InstagramWidget
 * @author Sashas IT Support <support@sashas.org>
 * @copyright 2007-2016 Sashas IT Support Inc. (http://www.sashas.org)
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @link http://www.extensions.sashas.org/instagram-widget.html
 */
$installer=$this;
$installer->startSetup();

$tagAttributeCode='instagram_tag';
$viewByCode='instagram_viewby';

$installer->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    $viewByCode,
    array(
            'group' => 'General',
            'input' => 'select',
            'type' => 'int',
            'label' => 'Instagram Show Posts From',
            'sort_order' => 2000,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'visible_in_advanced_search' => false,
            'is_html_allowed_on_front' => true,
            'option' => array(
                    'values' => array(
                            'username',
                            'tag'
                    )
            ),
            'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
    )
);

$installer->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    $tagAttributeCode,
    array(
            'group' => 'General',
            'input' => 'text',
            'type' => 'varchar',
            'label' => 'Instagram Find Posts By',
            'sort_order' => 2001,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'visible_in_advanced_search' => false,
            'is_html_allowed_on_front' => true,
            'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
    )
);

// $installer->updateAttribute(Mage_Catalog_Model_Product::ENTITY,$attributeCode,'used_in_product_listing',1);

$model=Mage::getModel('catalog/resource_eav_attribute');
$modelAttr=Mage::getModel('eav/entity_setup', 'core_setup');

$allAttributeSetIds=$model->getAllAttributeSetIds('catalog_product');
$attributeView=$model->getAttribute('catalog_product', $viewByCode);
$attributeTag=$model->getAttribute('catalog_product', $tagAttributeCode);

foreach ($allAttributeSetIds as $attributeSetId) {
    try {
        $attributeGroupId=$modelAttr->getAttributeGroup('catalog_product', $attributeSetId, 'General');
    } catch (Exception $e) {
        $attributeGroupId=$modelAttr->getDefaultArrtibuteGroupId('catalog/product', $attributeSetId);
    }
    $modelAttr->addAttributeToSet('catalog_product', $attributeSetId, $attributeGroupId, $attributeView);
    $modelAttr->addAttributeToSet('catalog_product', $attributeSetId, $attributeGroupId, $attributeTag);
}

$installer->endSetup();
