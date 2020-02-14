<?php

namespace App\Controller;


use App\Form\PlaceType;
use App\Entity\Place;
use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\SubscribedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PlaceController extends Controller
{
    /**
     * @Route("/addplace", name="add_place")
     */
    public function addPlace(EntityManagerInterface $entityManager, Request $request)
    {

      $place = new Place();

       $placeForm = $this->createForm(PlaceType::class, $place);
       $placeForm->handleRequest($request);

        if ($placeForm->isSubmitted()) {
            $villeStr = $placeForm->get('city')->getData();

            $placeRepository = $entityManager->getRepository(Place::class);
            $ville = $placeRepository->findByCity($villeStr);

            if (!empty($ville)) {
                $place->setCity($ville[0]);

                $this->addFlash(
                    'success',
                    'Lieu ajouté avec succès'
                );
                $entityManager->persist($place);
                $entityManager->flush();

                return $this->redirectToRoute("home");
            } else {
                $this->addFlash(
                    'warning',
                    'Le lieu est en dehors de la zone géographique'
                );
                return $this->redirectToRoute("add_place");

            }
        }

        return $this->render(
            'place/addplace.html.twig',
            ['placeFormView' => $placeForm->createView(),]
        );
    }
}
