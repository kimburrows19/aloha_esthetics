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
class Sashas_InstagramWidget_Adminhtml_InstagramController extends Mage_Adminhtml_Controller_Action
{

    /**
     * {@inheritDoc}
     * @see Mage_Core_Controller_Varien_Action::_construct()
     */
    protected function _construct()
    {
        // Define module dependent translate
        $this->setUsedModuleName('Sashas_InstagramWidget');
    }

    /**
     * Check for is allowed
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/config/instagramwidget');
    }

    /**
     * Controller predispatch method
     * @return Mage_Adminhtml_Controller_Action
     */
    public function preDispatch()
    {
        $secretKey=Mage::getSingleton('adminhtml/url')->getSecretKey('instagram', 'auth');
        $this->getRequest()->setParam(Mage_Adminhtml_Model_Url::SECRET_KEY_PARAM_NAME, $secretKey);
        parent::preDispatch();
    }

    /**
     * Instagram Authorization
     */
    public function authAction()
    {
        $instagramCode=$this->getRequest()->getParam('code', null);
        
        if (!$instagramCode) {
            Mage::log('Instagram didnt return code for access token', null, 'instagramwidget.log');
            $secretKey=Mage::getSingleton('adminhtml/url')->getSecretKey('system_config', 'edit');
            Mage::getSingleton('adminhtml/session')->addError('Instagram didnt return code for access token');
            $this->_redirect('adminhtml/system_config/edit/');
            return;
        }
        
        $clientId=Mage::getStoreConfig('instagramwidget/instagramwidget_group/client_id');
        $clientSecret=Mage::getStoreConfig('instagramwidget/instagramwidget_group/client_secret');
        
        $client=new Varien_Http_Client('https://api.instagram.com/oauth/access_token');
        $client->setMethod(Varien_Http_Client::POST);
        $client->setParameterPost('client_secret', $clientSecret);
        $client->setParameterPost('client_id', $clientId);
        $client->setParameterPost('code', $instagramCode);
        $client->setParameterPost('grant_type', 'authorization_code');
        $client->setParameterPost('redirect_uri', Mage::helper("instagramwidget")->getAuthUrl());
        
        try {
            $response=$client->request();
            
            if ($response->isSuccessful()) {
                $responseObject=json_decode($response->getBody());
                
                if (isset($responseObject->access_token)) {
                    Mage::getConfig()->saveConfig(
                        'instagramwidget/instagramwidget_group/access_token',
                        $responseObject->access_token
                    );
                } else {
                    Mage::log('Instagram token issue: '.$response->getBody(), null, 'instagramwidget.log');
                }
            }
        } catch (Exception $e) {
            Mage::log('Instagram token issue: '.$e->getMessage(), null, 'instagramwidget.log');
        }
        $this->_redirect('adminhtml/system_config/edit/');
    }
}
