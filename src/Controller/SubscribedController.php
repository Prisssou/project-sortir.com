<?php

namespace App\Controller;

use App\Entity\Subscribed;
use App\Form\SubscribedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscribedController extends Controller
{
    /**
     * @Route("/subscribed", name="subscribed")
     */
    public function index()
    {
        return $this->render('subscribed/index.html.twig', [
            'controller_name' => 'SubscribedController',
        ]);
    }

}
