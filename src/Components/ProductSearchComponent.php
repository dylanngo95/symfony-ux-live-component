<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('product_search')]
class ProductSearchComponent
{
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