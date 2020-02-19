<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends Controller
{
    /**
     * @Route("/city", name="city")
     */
    public function addCity()
    {
        return $this->render('outing/cities.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }
}
