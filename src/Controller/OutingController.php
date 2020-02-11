<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Entity\State;
use App\Entity\Place;
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

        if ($outingForm->isSubmitted()) {

            $outing->setClosingDate(new \DateTime('2020-02-11'));
            $outing->setNumberSub('0');
            $stateRepository = $entityManager->getRepository(State::class);
            $placeRepository = $entityManager->getRepository(Place::class);
            $outing->setPlace($place = $placeRepository->find('1'));

            if ($request->get('submitAction') == 'Enregistrer') {
                $outing->setState($state = $stateRepository->find('1'));
            } else {
                if ($request->get('submitAction') == 'Publier') {
                    $outing->setState($state = $stateRepository->find('2'));
                }
            }

        $this->addFlash(
            'success',
            'Sortie ajoutée avec succès'
        );

        $entityManager->persist($outing);
        $entityManager->flush();

        return $this->redirectToRoute("home");
    }

    return $this->render(
            'outing/add.html.twig',
            ['outingFormView' => $outingForm->createView(),]
        );
    }
}
