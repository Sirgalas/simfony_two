<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_base")
     */
    public function index(BookRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'books' => $repository->findByOrderAndLimit('asc',12),
        ]);
    }
}
