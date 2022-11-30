<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\productFormType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product')]
    public function index(ProductsRepository $productsRepository, int $id, EntityManagerInterface $em, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $product = $productsRepository->find($id);
        $order = new Order();
        $form = $this->createForm(productFormType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setStatus('To-Do');
            $order->setProducts($product);
            $em->persist($order);
            $em->flush();
            $this->addFlash('succes', 'Bedankt voor je bestelling');
            return $this->redirectToRoute("app_order");
        }

        return $this->renderform('product/index.html.twig', [
            'products' => $product,
            'form' => $form
        ]);
    }

}
