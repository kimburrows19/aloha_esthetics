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
class Sashas_InstagramWidget_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{

    /**
     * @see Mage_Core_Block_Template::_toHtml()
     */
    protected function _toHtml()
    {
        $searchBy=$this->_getData('search_by');
        $searchValue=$this->_getData('search_by_value');
        $postsCount=$this->_getData('posts_count');
        
        if ($searchBy=='username') {
            $userId=Mage::getModel('instagramwidget/instagram')->getUserIdByUsername($searchValue);
            $posts=Mage::getModel('instagramwidget/instagram')->getUserLastPosts($userId, $postsCount);
        } elseif ($searchBy=='tag') {
            $posts=Mage::getModel('instagramwidget/instagram')->getTagLastPosts($searchValue, $postsCount);
        }
        
        $imageResolution=$this->_getData('image_resolution');
        $blockTitle=$this->_getData('block_title');
        
        $block=$this->getLayout()
            ->createBlock('catalog/product_list')
            ->setTemplate('instagramwidget/widget.phtml')
            ->setBlockTitle($blockTitle)
            ->setImageResolution($imageResolution)
            ->setPostsCount($postsCount)
            ->setPosts($posts);
        
        return $block->toHtml();
    }
}
