<?php

namespace App\Controller;

use App\Api\Product;
use App\Factory\JsonResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
	private JsonResponseFactory $jsonResponseFactory;
	private ValidatorInterface $validatorInterface;
	private Product $product;

	public function __construct(
		JsonResponseFactory $jsonResponseFactory,
		ValidatorInterface $validatorInterface,
		Product $product
	) {
		$this->jsonResponseFactory = $jsonResponseFactory;
		$this->validatorInterface = $validatorInterface;
		$this->product = $product;
	}

	#[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'Product',
        ]);
    }

	/**
	 * @throws \Exception
	 */
	#[Route('/product/create', name: 'app_product_create', methods: ['POST'])]
	public function create(Request $request): JsonResponse
	{
		$constrains = new Collection([
			'name' => [
				new NotBlank(),
				new Length(['min' => 3])
			],
			'price' => [
				new GreaterThan(1)
			],
			'quantity' => []
		]);
		$validator = $this->validatorInterface->validate(
			json_decode($request->getContent(), true),
			$constrains
		);
		if (count($validator) > 0) {
			return new JsonResponse([
				'message' => 'hii'
			], 404);
		}
		$product = $this->product->build($request->getContent());
		return new JsonResponse([
			'message' => 'hii'
		]);
	}

}
