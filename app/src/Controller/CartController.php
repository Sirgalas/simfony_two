<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Services\BasketServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/{id}", name="cart")
     */
    public function cart(int $id,SessionInterface $session,Request $request)
    {
        $basket=$session->get("basket");
        !isset($basket[$id])&&$basket[$id]=0;
        $basket[$id]++;
        $session->set('basket',$basket);
       return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/basket" , name="basket")
     */
    public function basket(SessionInterface $session, BookRepository $repository, BasketServices $services)
    {

        return $this->render('cart/index.html.twig', [
            'booksItems' => $services->addBasketItem($session,$repository)
        ]);
    }

    /**
     * @Route("/basket/delete/{id}", name="basket_delete")
     */
    public function basketDelete(int $id, SessionInterface $session)
    {

    }
}
