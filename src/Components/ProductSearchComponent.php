<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent('product_search')]
class ProductSearchComponent
{
	use DefaultActionTrait;

	#[LiveProp(writable: true)]
	public string $query = '';


	public function getProducts(): array
	{
		$n = 5;
		$products = [];
		for ($i = 0; $i < $n; $i++) {
			$products[] = [
				'name' => 'Iphone 14 Pro',
				'price' => random_int(0, 1000)
			];
		}

		if ($this->query == '') {
			return $products;
		}
		return array_filter(
			$products,
			fn($value, $key) => $value['price'] == $this->query,
			ARRAY_FILTER_USE_BOTH
		);
	}
}