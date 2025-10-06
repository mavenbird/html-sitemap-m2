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
namespace Mavenbird\HtmlSiteMap\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class AddSitemap
 * @package Mavenbird\HtmlSiteMap\Observer
 */
class AddSitemap implements ObserverInterface
{
    /**
     * @var \Mavenbird\HtmlSiteMap\Block\ItemsCollection
     */
    private $siteMapBlock;

    /**
     * @var \Mavenbird\GeoIPAutoSwitchStore\Helper\Data
     */
    private $dataHelper;

    /**
     * AddSiteMap constructor.
     * @param \Mavenbird\HtmlSiteMap\Helper\Data $dataHelper
     * @param \Mavenbird\HtmlSiteMap\Block\ItemsCollection $siteMapBlock
     */
    public function __construct(
        \Mavenbird\HtmlSiteMap\Helper\Data $dataHelper,
        \Mavenbird\HtmlSiteMap\Block\ItemsCollection $siteMapBlock
    ) {
        $this->siteMapBlock = $siteMapBlock;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Add New Layout handle
     *
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return self
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $layout = $observer->getData('layout');
        $helper = $this->dataHelper;
        $orderTemplates = $helper->orderTemplates();

        $block = $this->siteMapBlock;

        if ($orderTemplates == '' || $orderTemplates == null) {
            $orderTemplates = $block::PRODUCT_LIST_NUMBER . ',' . $block::STORE_VIEW_LIST_NUMBER . ',' . $block::ADDITIONAL_LIST_NUMBER . ',' . $block::CATE_AND_CMS_NUMBER;
        }

        $orderTemplates = "," . $orderTemplates . ",";
        $orderTemplates = explode(',', $orderTemplates);

        $fullActionName = $observer->getData('full_action_name');

        if ($fullActionName != 'custom_route_index_index') {
            return $this;
        }

        foreach ($orderTemplates as $key) {
            if ($key == $block::PRODUCT_LIST_NUMBER) {
                $layout->getUpdate()->addHandle('sitemap_product_list');
            }

            if ($key == $block::STORE_VIEW_LIST_NUMBER) {
                $layout->getUpdate()->addHandle('sitemap_store_list');
            }

            if ($key == $block::ADDITIONAL_LIST_NUMBER) {
                $layout->getUpdate()->addHandle('sitemap_additional_list');
            }

            if ($key == $block::CATE_AND_CMS_NUMBER) {
                $layout->getUpdate()->addHandle('sitemap_category_cms_list');
            }
        }

        return $this;
    }
}
