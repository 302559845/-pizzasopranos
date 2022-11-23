<?php

namespace App\Controller;

use App\Form\productFormType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product')]
    public function index(ProductsRepository $productsRepository, int $id, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(productFormType::class);
        $products = $productsRepository->find( $id);
        return $this->renderform('product/index.html.twig', [
            'products' => $products, 'formProduct'=>$form
        ]);
    }

}
