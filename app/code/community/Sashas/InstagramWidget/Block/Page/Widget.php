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
class Sashas_InstagramWidget_Block_Page_Widget extends Mage_Core_Block_Template
{

    /**
     *
     * @return Mage_Instagramwidget_Model_Instagram
     */
    public function loadFeed()
    {
        $viewType=$this->getViewType();
        if (!$viewType) {
            $viewType="custom_block";
        }
        
        $searchBy=Mage::getStoreConfig('instagramwidget/'.$viewType.'/search_by');
        $searchValue=Mage::getStoreConfig('instagramwidget/'.$viewType.'/search_by_value');
        $postsCount=Mage::getStoreConfig('instagramwidget/'.$viewType.'/posts_count');
        
        $product=Mage::registry('current_product');
        if ($product instanceof Mage_Catalog_Model_Product) {
            if ($product->getInstagramTag() && $product->getInstagramViewby()) {
                $searchBy=$product->getAttributeText('instagram_viewby');
                $searchValue=$product->getInstagramTag();
            }
        }
        
        if ($viewType=='instagramwidget_product_page') {
            $this->setTitle(Mage::getStoreConfig('instagramwidget/'.$viewType.'/block_title'));
        }
        
        if ($searchBy=='username') {
            $userId=Mage::getModel('instagramwidget/instagram')->getUserIdByUsername($searchValue);
            $posts=Mage::getModel('instagramwidget/instagram')->getUserLastPosts($userId, $postsCount);
        } elseif ($searchBy=='tag') {
            $posts=Mage::getModel('instagramwidget/instagram')->getTagLastPosts($searchValue, $postsCount);
        }
        
        return $posts;
    }

    /**
     * Widget imageresolution
     */
    public function getResolution()
    {
        $viewType=$this->getViewType();
        if (!$viewType) {
            $viewType="custom_block";
        }
        
        return Mage::getStoreConfig('instagramwidget/'.$viewType.'/image_resolution');
    }

    /**
     * Instagram widget title
     */
    public function getBlockTitle()
    {
        $viewType=$this->getViewType();
        if (!$viewType) {
            $viewType="custom_block";
        }
        
        return Mage::getStoreConfig('instagramwidget/'.$viewType.'/block_title');
    }
}
