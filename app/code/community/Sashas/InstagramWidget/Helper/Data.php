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
class Sashas_InstagramWidget_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @return string|number
     */
    public function canShowIfLayeredLeft()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_category/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_category/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='left') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfLayeredRight()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_category/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_category/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='right') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfNonLayeredLeft()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_nonanchor_category/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_nonanchor_category/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='left') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfNonLayeredRight()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_nonanchor_category/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_nonanchor_category/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='right') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfCmsIndexLeft()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_index/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_index/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='left') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfCmsIndexRight()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_index/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_index/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='right') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfCmsPagesLeft()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_pages/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_pages/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='left') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfCmsPagesRight()
    {
        $template="instagramwidget/page_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_pages/extension_enabled');
        $layeredPosition=Mage::getStoreConfig('instagramwidget/instagramwidget_cms_pages/layered_position');
        
        if (!$layeredEnabled || $layeredPosition!='right') {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return string|number
     */
    public function canShowIfProductPage()
    {
        $template="instagramwidget/product_widget.phtml";
        $layeredEnabled=Mage::getStoreConfig('instagramwidget/instagramwidget_product_page/extension_enabled');
        
        if (!$layeredEnabled) {
            $template=0;
        }
        
        return $template;
    }

    /**
     * @return mixed
     */
    public function getAuthUrl()
    {
        $returnUrl=Mage::helper("adminhtml")->getUrl("adminhtml/instagram/auth");
        $secureKey=Mage::getSingleton('adminhtml/url')->getSecretKey('instagram', 'auth');
        $keyString=Mage_Adminhtml_Model_Url::SECRET_KEY_PARAM_NAME.'/'.$secureKey.'/';
        $replaceString='?magento=1';
        $returnUrl=str_replace($keyString, $replaceString, $returnUrl);
        return $returnUrl;
    }
}
