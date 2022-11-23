<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/', name: 'app_home')]
    public function index2(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories'=>$categories
        ]);
    }
    #[Route('/category/{id}', name: 'app_category')]
    public function index3(ProductsRepository $productsRepository, int $id): Response
    {
        $products = $productsRepository->findBy(['category' => $id]);
        return $this->render('category/index.html.twig', [
            'products' => $products,
        ]);
    }

}
