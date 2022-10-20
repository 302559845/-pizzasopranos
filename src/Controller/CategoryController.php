<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category')]
    public function index($id, ProductsRepository $productsRepository): Response
    {
//        $products = $productsRepository->findBy(array('category' => $id));
        $products = $productsRepository->findAll();

//        dd($products);
        return $this->render('category/index.html.twig', [
            'products' => $products,
        ]);
    }
}
