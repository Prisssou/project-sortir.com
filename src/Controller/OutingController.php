<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Entity\State;
use App\Entity\Place;
use App\Form\OutingType;
use App\Form\SubscribedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $outing->addMember($user);
        }

        $outingForm = $this->createForm(OutingType::class, $outing);
        $outingForm->handleRequest($request);

        if ($outingForm->isSubmitted()) {

            $outing->setClosingDate(new \DateTime('2020-02-11'));
            $outing->setNumberSub('0');
            $stateRepository = $entityManager->getRepository(State::class);
            $placeRepository = $entityManager->getRepository(Place::class);
            $outing->setPlace($place = $placeRepository->find('1'));

            $outing->setSite($user->getSite());


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

    /**
     * @Route("/detail/{id}", name="detail")
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function detail($id, EntityManagerInterface $entityManager, Request $request)
    {
        // Récupération de la sortie
        $outingRepository = $entityManager->getRepository(Outing::class);
        $outing = $outingRepository->find($id);
        dump($outing);

        // Récupération de la liste des participants
//        $id = $outing->getId();
//        $subList = $entityManager->getRepository(Subscribed::class)->find($id);

        return $this->render(
            'outing/detailOuting.html.twig',
//            compact('outing', 'subList')
            compact('outing')
        );

    }

}

