<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\productFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
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
    #[Route('/product/{id}', name: 'app_product')]
    public function index4(ProductsRepository $productsRepository, int $id, EntityManagerInterface $em, \Symfony\Component\HttpFoundation\Request $request): Response
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
