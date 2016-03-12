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
class Sashas_InstagramWidget_Model_Source_PopupOption
{

    protected $_options;

    /**
     * Options ofmodelwindow
     */
    public function toOptionArray()
    {
        if ($this->_options) {
            return $this->_options;
        }
        $this->_options[]=array(
                'label' => 'Full Image',
                'value' => 'full_image'
        );
        $this->_options[]=array(
                'label' => 'Instagram Iframe',
                'value' => 'iframe'
        );
        return $this->_options;
    }
}
