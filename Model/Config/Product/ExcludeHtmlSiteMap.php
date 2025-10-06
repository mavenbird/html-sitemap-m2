<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category   Mavenbird
 * @package    Mavenbird_HtmlSiteMap
 * @author     Mavenbird Team
 * @copyright  Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license    http://mavenbird.com/Mavenbird-Module-License.txt
 */
namespace Mavenbird\HtmlSiteMap\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class ExcludeHtmlSiteMap
 * @package Mavenbird\HtmlSiteMap\Model\Config\Product
 */
class ExcludeHtmlSiteMap extends AbstractSource
{
    /**
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [];
        $this->_options[] = ['label' => 'No', 'value' => '0'];
        $this->_options[] = ['label' => 'Yes', 'value' => '1'];
        return $this->_options;
    }
}
