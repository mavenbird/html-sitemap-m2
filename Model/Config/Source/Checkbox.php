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
namespace Mavenbird\HtmlSiteMap\Model\Config\Source;

/**
 * Class Checkbox
 * @package Mavenbird\HtmlSiteMap\Model\Config\Source
 */
class Checkbox extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    public $pageFactory;

    /**
     * @var \Magento\Cms\Model\Page
     */
    public $page;

    /**
     * Checkbox constructor.
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\Page $page,
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->page = $page;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $this->getStoreId();
        $cms = [];
        $page = $this->pageFactory->create();
        foreach ($page->getCollection() as $item) {
            $cms[$item->getId()] = $item->getTitle();
        }

        $cmsArray = [];
        $count = 0;
        foreach ($cms as $id => $title) {
            $cmsArray[$count]['value'] = $id;
            $cmsArray[$count]['label'] = $title;
            $count++;
        }
        return $cmsArray;
    }
}
