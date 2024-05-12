<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/')]
class HomeController extends AbstractController
{   

    #[Route('', name: 'app_home', methods:['GET','POST'])]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            
        ]);
    }
}