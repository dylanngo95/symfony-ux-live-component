<?php

namespace App\Api;

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class Product
{
	#[NotBlank]
	private string $name;

	#[GreaterThan(1)]
	private float $price;

	#[GreaterThan(1)]
	private int $quantity;

	public function build(string $data): static
	{
		$properties = json_decode($data, true);
		foreach ($properties as $key => $value) {
			$this->$key = $value;
		}
		return $this;
	}
}