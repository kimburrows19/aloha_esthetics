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
class Sashas_InstagramWidget_Model_System_Config_AccessToken
{

    /**
     * @return string
     */
    public function getCommentText()
    {
        $returnUrl=Mage::helper("instagramwidget")->getAuthUrl();
        $clientId=Mage::getStoreConfig('instagramwidget/instagramwidget_group/client_id');
        $url='<a href="https://api.instagram.com/oauth/authorize/?client_id='.$clientId;
        $url.='&response_type=code&scope=public_content&redirect_uri='.$returnUrl.'">Authorize Magento Application</a>';
        return $url;
    }
}
