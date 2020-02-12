<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PlaceController extends Controller
{
    /**
     * @Route("/place", name="add_place")
     */
    public function addPlace(EntityManagerInterface $entityManager, Request $request)
    {

        return $this->render('place/addplace.html.twig', [
            'controller_name' => 'PlaceController',
        ]);
    }
}
