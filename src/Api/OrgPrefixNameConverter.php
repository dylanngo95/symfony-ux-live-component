<?php

namespace App\Api;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class OrgPrefixNameConverter implements NameConverterInterface
{
	public function normalize(string $propertyName): string
	{
		return 'org_'.$propertyName;
	}

	public function denormalize(string $propertyName): string
	{
		// removes 'org_' prefix
		return 'org_' === substr($propertyName, 0, 4) ? substr($propertyName, 4) : $propertyName;
	}
}