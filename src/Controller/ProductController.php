<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product')]
    public function index(ProductsRepository $productsRepository, int $id): Response
    {
        $products = $productsRepository->find( $id);
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
