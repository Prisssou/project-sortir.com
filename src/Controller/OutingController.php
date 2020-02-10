<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Form\OutingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OutingController extends Controller
{
    /**
     * @Route("/add", name="add_outing")
     */
    public function addOuting(EntityManagerInterface $entityManager, Request $request)
    {
        $outing = new Outing();
        // Todo : ajout de l'user pour chaque sortie

        $outingForm = $this->createForm(OutingType::class, $outing);
        $outingForm->handleRequest($request);

        if($outingForm->isSubmitted()){

            $this->addFlash(
                'success',
                'Sortie ajoutée avec succès'
            );

            $entityManager->persist($outing);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('outing/add.html.twig',
            [
            'outingFormView' => $outingForm->createView(),
            ]
        );
    }
}
