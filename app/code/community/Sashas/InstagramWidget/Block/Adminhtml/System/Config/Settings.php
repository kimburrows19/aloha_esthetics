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
class Sashas_InstagramWidget_Block_Adminhtml_System_Config_Settings extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

   
    /**
     * {@inheritDoc}
     * @see Mage_Adminhtml_Block_System_Config_Form_Fieldset::render()
     * @return String
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $returnUrl=Mage::helper("instagramwidget")->getAuthUrl();
        $returnMessage='<p class="switcher">Please Following Valid Redirect Url';
        $returnMessage.=' At The Security Tab Of Instagram Client Settings: '.$returnUrl;
            
        return $returnMessage;
    }
}
