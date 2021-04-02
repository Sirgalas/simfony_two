<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BookRepository $repository): Response
    {

        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'books'=>$repository->findAll()
        ]);
    }
}
