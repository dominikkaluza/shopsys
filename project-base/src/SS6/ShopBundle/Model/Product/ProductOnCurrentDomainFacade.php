<?php

namespace SS6\ShopBundle\Model\Product;

use SS6\ShopBundle\Model\Domain\Domain;
use SS6\ShopBundle\Model\Product\Detail\Factory;
use SS6\ShopBundle\Model\Product\ProductRepository;

class ProductOnCurrentDomainFacade {

	/**
	 * @var \SS6\ShopBundle\Model\Product\ProductRepository
	 */
	private $productRepository;

	/**
	 * @var \SS6\ShopBundle\Model\Domain\Domain
	 */
	private $domain;

	/**
	 * @var \SS6\ShopBundle\Model\Product\Detail\Factory
	 */
	private $productDetailFactory;

	/**
	 * @param \SS6\ShopBundle\Model\Product\ProductRepository $productRepository
	 * @param \SS6\ShopBundle\Model\Domain\Domain $domain
	 * @param \SS6\ShopBundle\Model\Product\Detail\Factory $productDetailFactory
	 */
	public function __construct(ProductRepository $productRepository, Domain $domain, Factory $productDetailFactory) {
		$this->productRepository = $productRepository;
		$this->domain = $domain;
		$this->productDetailFactory = $productDetailFactory;
	}

	/**
	 * @return \SS6\ShopBundle\Model\Product\Detail\Detail[]
	 */
	public function getAllVisibleProductDetails() {
		$products = $this->productRepository->getAllVisibleByDomainId($this->domain->getId());
		
		return $this->productDetailFactory->getDetailsForProducts($products);
	}

	/**
	 * @param int $productId
	 * @return \SS6\ShopBundle\Model\Product\Detail\Detail
	 */
	public function getVisibleProductDetailById($productId) {
		$product = $this->productRepository->getVisibleByIdAndDomainId($productId, $this->domain->getId());

		return $this->productDetailFactory->getDetailForProduct($product);
	}

}