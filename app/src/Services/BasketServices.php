<?php

namespace App\Services;

use App\Repository\BookRepository;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketServices
{
    const SESSION_NAME='basket';

    public function addBasketItem(SessionInterface $session ,BookRepository $repository):array
    {
        $basket=$session->get(self::SESSION_NAME);
        $books=[];
        if(is_array($basket)){
            $books=$repository->findByIn(implode(',',array_keys($basket)));
        }
        $booksItems=[];
        foreach($books as $book){
            array_push($booksItems,[
                'book'=>$book,
                'quantity'=>$basket[$book->getId()]
            ]);
        }
        return $booksItems;
    }

    public function  delBasketItem(SessionInterface $session)
    {
        $session->set(self::SESSION_NAME,'');
    }
}
