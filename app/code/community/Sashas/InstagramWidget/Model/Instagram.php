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
class Sashas_InstagramWidget_Model_Instagram extends Mage_Core_Model_Abstract
{

    const CACHE_TAG='instagramwidget';

    /**
     * {@inheritDoc}
     * @see Varien_Object::_construct()
     */
    public function _construct()
    {
        $this->_init("instagramwidget/instagram");
    }

    /**
     *
     * @param string $url
     * @return Varien_Object|boolean
     */
    public function connect($url)
    {
        
        /* Cache */
        Varien_Profiler::start(__METHOD__);
        $storeId=(int) Mage::app()->getStore()->getId();
        $cacheId=$url.'-'.$storeId;
        $cacheGroup='sashas_instagtramwidget';
        $useCache=Mage::app()->useCache($cacheGroup);
        
        if (true===$useCache && $cacheContent=Mage::app()->loadCache($cacheId)) {
            $data=unserialize($cacheContent);
            if (!empty($data)) {
                $objectData=new Varien_Object($data);
                return $objectData;
            }
        }
        
        /* Cache */
        
        try {
            $curlConnection=curl_init($url);
            curl_setopt($curlConnection, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, false);
            
            /* Data are stored in $data */
            $data=json_decode(curl_exec($curlConnection), true);
            curl_close($curlConnection);
            /* Cache */
            $objectData=new Varien_Object($data);
            if (true===$useCache) {
                $cacheContent=serialize($data);
                $tags=array(
                        Sashas_InstagramWidget_Model_Instagram::CACHE_TAG
                );
                
                $lifetime=Mage::getStoreConfig('instagramwidget/instagramwidget_cache/cache_lifetime');
                Mage::app()->saveCache($cacheContent, $cacheId, $tags, $lifetime);
            }
            /* Cache */
            Varien_Profiler::stop(__METHOD__);
            
            if (isset($data['meta']) && isset($data['error_type'])) {
                Mage::log($data, null, 'instagramwidget.log');
            }
            
            return $objectData;
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'instagramwidget.log');
            return false;
        }
    }

    /**
     * @return Varien_Object|boolean
     */
    public function testRequest()
    {
        $apiUrl='users/self/?access_token={{access_token}}';
        return $this->executeQuery($apiUrl);
    }

    /**
     * @param unknown $q
     * @return Varien_Object|boolean
     */
    public function executeQuery($q)
    {
        $apiUrl='https://api.instagram.com/v1/'.$q;
        $accessToken=Mage::getStoreConfig('instagramwidget/instagramwidget_group/access_token');
        $apiUrl=str_replace('{{access_token}}', $accessToken, $apiUrl);
        Mage::log($apiUrl, null, 'instagramwidget.log');
        return $this->connect($apiUrl);
    }

    /**
     * @param unknown $query
     * @param number  $count
     * @return Varien_Object|boolean
     */
    public function search($query, $count = 1)
    {
        $searchUrl="users/search?q=".$query."&count=".$count."&access_token={{access_token}}";
        return $this->executeQuery($searchUrl);
    }

    /**
     * @param unknown $username
     */
    public function getUserIdByUsername($username)
    {
        if ($data=$this->search($username)) {
            foreach ($data->getData('data') as $user) {
                if ($user['username']==str_replace('@', '', $username)) {
                    return $user['id'];
                }
            }
        }
        
        return;
    }

    /**
     * @param unknown $userId
     * @param number  $count
     * @return Varien_Object|Varien_Object|boolean
     */
    public function getUserLastPosts($userId, $count = 20)
    {
        if (!$userId) {
            Mage::log("User Id Not specified for lastest posts", null, 'instagramwidget.log');
            return new Varien_Object();
        }
        $recentUrl="users/".$userId."/media/recent/?count=".$count."&access_token={{access_token}}";
        if (!$recentPosts=$this->executeQuery($recentUrl)) {
            $recentPosts=new Varien_Object();
        }
        
        return $recentPosts;
    }

    /**
     * @param unknown $tag
     * @param number  $count
     * @return Varien_Object|Varien_Object|boolean
     */
    public function getTagLastPosts($tag, $count = 20)
    {
        if (!$tag) {
            Mage::log("Tag Not specified for lastest posts", null, 'instagramwidget.log');
            return new Varien_Object();
        }
        
        $recentUrl="tags/".$tag."/media/recent/?count=".$count."&access_token={{access_token}}";
        if (!$recentPosts=$this->executeQuery($recentUrl)) {
            $recentPosts=new Varien_Object();
        }
        
        return $recentPosts;
    }
}
