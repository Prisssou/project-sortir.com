<?php

namespace App\Controller;

use App\Entity\Subscribed;
use App\Form\SubscribedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SuscribedController extends Controller
{
    /**
     * @Route("/suscribed", name="suscribed")
     */
    public function index()
    {
        return $this->render('suscribed/index.html.twig', [
            'controller_name' => 'SuscribedController',
        ]);
    }

    public function addSubscription(EntityManagerInterface $entityManager, Request $request){
        $subscription = new Subscribed();
        $subForm = $this->createForm(SubscribedType::class, $subscription);
        $subForm->handleRequest($request);

        if ($subForm->isSubmitted() && $subForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscription);
            $entityManager->flush();
        }


    }
}
