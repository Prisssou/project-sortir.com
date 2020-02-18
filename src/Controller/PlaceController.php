<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class PlaceController extends Controller
{
    /**
     * @Route("/addplace", name="add_place")
     */
    public function addPlace(EntityManagerInterface $entityManager, Request $request)
    {

        $place = new Place();

        $data = $request ->request->all();
        $place->setName($data['place']['name']);
        $place->setStreet($data['place']['street']);
        $place->setZipcode($data['place']['zipcode']);
        $place->setLatitude($data['place']['latitude']);
        $place->setLongitude($data['place']['longitude']);

        $villeRepository = $entityManager->getRepository(Ville::class);
        $ville = $villeRepository->findBy(['nom' => $data['place']['city']]);
        $place->setCity($ville['0']);

        $entityManager->persist($place);
        $entityManager->flush();


        return new JsonResponse([
            'status'=> 'ok',
            'place'=> $place,
        ]);

    }
}

