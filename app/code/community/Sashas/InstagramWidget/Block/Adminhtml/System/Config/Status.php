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
class Sashas_InstagramWidget_Block_Adminhtml_System_Config_Status extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    /**
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $clientId=Mage::getStoreConfig('instagramwidget/instagramwidget_group/client_id');
        $clientSecret=Mage::getStoreConfig('instagramwidget/instagramwidget_group/client_secret');
        $accessToken=Mage::getStoreConfig('instagramwidget/instagramwidget_group/access_token');
        if (!$clientId) {
            $status="Client ID is empty or not saved";
            $state="critical";
        } elseif (!$clientSecret) {
            $status="Client Secret is empty or not saved";
            $state="critical";
        } elseif (!$accessToken) {
            $status="Please Receive Access Token Below";
            $state="critical";
        } else {
            $apiResponse=Mage::getModel('instagramwidget/instagram')->testRequest();
            $meta=$apiResponse->getMeta();
            if (isset($meta['error_message'])) {
                $status=$meta['error_message'];
                $state="minor";
            } elseif (isset($meta['code']) && $meta['code']!=200) {
                Mage::log('Instagram Admin Authorization Issue: '.$meta, null, 'instagramwidget.log');
                Mage::log($meta, null, 'instagramwidget.log');
                $status='Authorization Issue';
                $state="minor";
            } else {
                $status='Valid';
                $state="notice";
            }
        }
        
        return '<span class="grid-severity-'.$state.'"><span style=" background-color: #FAFAFA;">'.$status.
            '</span></span>';
    }
}
