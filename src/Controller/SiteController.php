<?php

namespace App\Controller;

use App\Form\SiteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends Controller
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {

        return $this->render(
            'outing/sites.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }
}
