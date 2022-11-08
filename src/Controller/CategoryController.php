<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category')]
    public function index(ProductsRepository $productsRepository, int $id): Response
    {
        $products = $productsRepository->findBy(['category' => $id]);
        return $this->render('category/index.html.twig', [
            'products' => $products,
        ]);
    }
}
