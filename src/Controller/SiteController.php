<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends Controller
{
    /**
     * @Route("/site", name="site")
     */
    public function sites()
    {
        return $this->render(
            'outing/sites.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }
}
