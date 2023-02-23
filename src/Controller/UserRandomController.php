<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserRandomController extends AbstractController
{

	#[Route('/user/random', name: 'app_random_user')]
	public function index(
		UserPasswordHasherInterface $passwordHasher,
		UserRepository $userRepository
	): Response {
		$n = 100000;
		for ($i = 0; $i < $n; $i++) {
			$user = new User();
			$plaintextPassword = '123456';
			// hash the password (based on the security.yaml config for the $user class)
			$hashedPassword = $passwordHasher->hashPassword(
				$user,
				$plaintextPassword
			);
			$user->setPassword($hashedPassword);
			$emailFake = hash('sha256', time());
			$user->setEmail("$emailFake.tinhngo@gmail.com");
			$user->setRoles(['admin']);

			$userRepository->save($user, true);
		}

		return $this->render('random_user/index.html.twig', [
			'controller_name' => 'RandomUserController',
		]);
	}
}
