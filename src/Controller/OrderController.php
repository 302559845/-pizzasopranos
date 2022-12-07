<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findAll();
        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }
    #[Route('/status{id}', name: 'status_change')]
    public function status($id, OrderRepository $orderRepository, EntityManagerInterface $entityManager){
        $order = $orderRepository->find($id);
        if ($order->getStatus() == 'To-Do'){
            $order->setStatus('In progress');
        }   elseif ($order->getStatus() == 'In progress') {
            $order->setStatus('DONE');
        }else{
            $order->setStatus('DONE');
        }

        $entityManager->persist($order);
        $entityManager->flush();

        return $this->redirectToRoute('app_order');
    }

}
