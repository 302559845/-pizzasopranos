<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/contoller', name: 'app_contact_contoller')]
    public function index(): Response
    {
        return $this->render('contact_contoller/index.html.twig', [
            'controller_name' => 'ContactContollerController',
        ]);
    }
}
