<?php

namespace App\Components;

use App\Repository\UserRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('user_search')]
class UserSearchComponent
{
	use DefaultActionTrait;

	private UserRepository $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	#[LiveProp(writable: true)]
	public string $query = '';

	public function getUsers(): array
	{
		if ($this->query == '') return $this->userRepository->findAll();
		return $this->userRepository->findBy(['id' => $this->query]);
	}
}