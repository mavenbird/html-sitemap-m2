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
namespace Mavenbird\HtmlSiteMap\Model\Config\Backend;


/**
 * Class ProcessUrlKey
 * @package Mavenbird\HtmlSiteMap\Model\Config\Backend
 */
class ProcessUrlKey extends \Magento\Framework\App\Config\Value
{
    /**
     * @var \Mavenbird\HtmlSiteMap\Helper\Data
     */
    private $dataHelper;

    /**
     * ProcessUrlKey constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param \Mavenbird\HtmlSiteMap\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Mavenbird\HtmlSiteMap\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $registry,
            $config,
            $cacheTypeList,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return \Magento\Framework\App\Config\Value
     */
    public function beforeSave()
    {
        /* @var array $value */
        $value = $this->getValue();
        if ($value) {
            $value = chop($value);
            $value = preg_replace("/\r\n|\r|\n/", ' ', $value);
            $value = preg_replace('/[\s]+/mu', ' ', $value);
            $value = trim($value);
            $value = rtrim($value, ",");
            $value = $this->dataHelper->createSlugByString($value);
        } else {
            $value = \Mavenbird\HtmlSiteMap\Helper\Data::DEFAULT_URL_KEY;
        }
        $this->setValue($value);
        return parent::beforeSave();
    }
}
