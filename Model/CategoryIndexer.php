<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_IndexerUrlRewrite
 * @copyright   Copyright (c) 2017 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Faonni\IndexerUrlRewrite\Model;

use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGenerator;
use Magento\UrlRewrite\Model\UrlPersistInterface;

/**
 * IndexerUrlRewrite category indexer model
 */
class CategoryIndexer extends AbstractIndexer
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    protected $_categoryCollection;
    
    /**
     * @var \Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGenerator
     */
    protected $_categoryUrlRewriteGenerator;
        
    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category\Collection $categoryCollection
     * @param \Magento\Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGenerator $categoryUrlRewriteGenerator
     * @param \Magento\UrlRewrite\Model\UrlPersistInterface $urlPersist
     */
    public function __construct(
        CategoryCollection $categoryCollection,
        CategoryUrlRewriteGenerator $categoryUrlRewriteGenerator,        
        UrlPersistInterface $urlPersist
    ) {
        $this->_categoryCollection = $categoryCollection;
        $this->_categoryUrlRewriteGenerator = $categoryUrlRewriteGenerator;   
        parent::__construct($urlPersist);
    }
    	
    /**
     * Retrieve entity collection
     *
     * @param integer $storeId
     * @return object
     */
	protected function getEntityCollection($storeId)
	{
		$this->_categoryCollection->setStoreId($storeId)
			->addAttributeToSelect(['url_path', 'url_key'])
			->addAttributeToFilter('level', array('gt' => 1));
			
		return $this->_categoryCollection;
	}
    
    /**
     * Retrieve entity type
     *
     * @return string
     */
	protected function getEntityType()
	{
		return CategoryUrlRewriteGenerator::ENTITY_TYPE;	
	}
    
    /**
     * Retrieve entity rewrite generator
     *
     * @return object
     */
	protected function getRewriteGenerator()
	{
		return $this->_categoryUrlRewriteGenerator;
	}
}
