<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends Controller
{
    /**
     * @Route("/city", name="city")
     */
    public function addCity(EntityManagerInterface $em, Request $request)
    {
        $ville = new Ville();

        $villeForm = $this->createForm(VilleType::class, $ville);
        $villeForm->handleRequest($request);

        if ($villeForm->isSubmitted()) {
            $villeRepository = $em->getRepository(Ville::class);
            $city = $villeRepository->findBy(['nom' => $ville->getNom()]);

            if (empty($city)) {
                $this->addFlash(
                    'success',
                    'Ville ajoutée avec succès'
                );
                $em->persist($ville);
                $em->flush();

                return $this->redirectToRoute("home");
            }
            $this->addFlash(
                'warning',
                'Erreur lors de l\'ajout de la ville : la ville existe déjà ',
            );

        }

        return $this->render(
            'outing/cities.html.twig',
            [
                'villeFormView' => $villeForm->createView(),
            ]
        );
    }
}
