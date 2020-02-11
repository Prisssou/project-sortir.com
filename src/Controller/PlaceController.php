<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends Controller
{
    /**
     * @Route("/place", name="place")
     */
    public function index()
    {
        return $this->render('outing/places.html.twig', [
            'controller_name' => 'PlaceController',
        ]);
    }
}
