<?php

namespace Goodson\CategoryRedirect\Helper\Catalog\Category;

class Plugin
{

    /**
     * Category factory
     *
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * Helper
     *
     * @var \Goodson\CategoryRedirect\Helper\Data
     */
    protected $_helper;

    /**
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Goodson\CategoryRedirect\Helper\Data $helper
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_helper = $helper;
    }

    /**
     * Overwrite category URL if redirect is configured
     *
     * @see \Magento\Catalog\Helper\Category::getCategoryUrl
     *
     * @param \Magento\Catalog\Helper\Category $subject
     * @param \Closure $proceed
     * @param $category
     * @return string
     */
    public function aroundGetCategoryUrl(\Magento\Catalog\Helper\Category $subject, \Closure $proceed, $category) {

        if ($category instanceof \Magento\Catalog\Model\Category) {
            $redirect = $category->getRedirectUrl();
        } else {
            $category = $this->_categoryFactory->create()->setData($category->getData());
            $redirect = $category->getRedirectUrl();
        }

        if ($redirect) {
            if (filter_var($redirect, FILTER_VALIDATE_URL)) {
                return $redirect;
            }
            return $this->_helper->buildUrl($redirect);
        }

        return $proceed($category);
    }

}