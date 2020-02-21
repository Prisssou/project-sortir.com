<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Entity\State;
use App\Entity\Place;
use App\Entity\Subscription;
use App\Form\OutingType;
use App\Form\PlaceType;
use App\Form\SubscribedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $place = new Place();
        $placeForm = $this->createForm(PlaceType::class, $place);

        if ($outingForm->isSubmitted()) {
            $outing->setClosingDate($outing->getLimitDateSub());
            $outing->setNumberSub('0');
            $stateRepository = $entityManager->getRepository(State::class);

            $outing->setSite($user->getSite());

            if ($request->get('submitAction') == 'Enregistrer') {
                $outing->setState($state = $stateRepository->find('1'));
                $outing->setStatus('Creee');
            } else {
                if ($request->get('submitAction') == 'Publier') {
                    $outing->setState($state = $stateRepository->find('2'));
                    $outing->setStatus('Ouverte');
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
            [
                'outingFormView' => $outingForm->createView(),
                'placeFormView' => $placeForm->createView(),
            ]
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

        // Récupération de la liste des participants
        $subscriptionRepository = $entityManager->getRepository(Subscription::class);
        $subList = $subscriptionRepository->findBy(['outing' => $outing->getId()]);

        return $this->render(
            'outing/detailOuting.html.twig',
            compact('outing', 'subList')
//            compact('outing')
        );

    }

    // S'inscrire à une sortie

    /**
     * @Route("/subscribe/{id}", name="subscribe")
     */
    public function addSubscription($id, EntityManagerInterface $entityManager, Request $request)
    {

        // Récupération de la sortie
        $outingRepository = $entityManager->getRepository(Outing::class);
        $outing = $outingRepository->find($id);

        // Attributs pour conditions
        $numSubs = $outing->getSubscriptions();

        $maxSubs = $outing->getNumberMaxSub();
        $dateMaxSub = $outing->getLimitDateSub();
        $today = date('now');

        // Récuparation de l'utilisateur courant
        $user = $this->getUser();

        if (sizeof($numSubs) < $maxSubs and $dateMaxSub > $today) {
            // Hydratation de la BDD
            $subscription = new Subscription();
            $subscription->setMember($user);
            $subscription->setOuting($outing);
            $subscription->setSubDate(new \DateTime('now'));


            if(sizeof($numSubs)+1 == $maxSubs){
                $outing->setStatus('Cloturee');
                $entityManager->persist($outing);
            }

            $entityManager->persist($subscription);
            $entityManager->flush();

            $this->addFlash('success', 'Votre inscription a bien été prise en compte !');

            return $this->redirectToRoute('home');
        }


        if (sizeof($numSubs) > $maxSubs) {
            $this->addFlash('error', 'Le nombre maximum de participant est atteint :( ');
        }

        if ($dateMaxSub < $today) {
            $this->addFlash('error', 'La date limite d\'inscription est dépassée :( ');

        }
        return $this->redirectToRoute('home');


    }

    // Se désinscrire d'une sortie

    /**
     * @Route("/unsubscribe/{id}", name="unsubscribe")
     * @param $id
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function cancelSubscription($id, EntityManagerInterface $em, Request $request)
    {
        // Récupération de l'utilisateur courant
        $member = $this->getUser();

        // Récupération de la sortie
        $outingRepository = $em->getRepository(Outing::class);
        $outing = $outingRepository->find($id);

        // Récupération de l'inscription
        $subRepository = $em->getRepository(Subscription::class);
        $subscription = $subRepository->findBy(
            ['outing' => $outing->getId(), 'member' => $member->getId()],
            ['outing' => 'ASC']
        );

        $numSubs = $outing->getSubscriptions();
        $maxSubs = $outing->getNumberMaxSub();
        $currentState = $outing->getStatus();
        if(sizeof($numSubs)-1 < $maxSubs && $currentState == 'Cloturee'){
            $outing->setStatus('Ouverte');
            $em->persist($outing);
        }

        $em->remove($subscription[0]);
        $em->flush();


        $this->addFlash('success', 'Votre annulation a bien été prise en compte');

        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/cancel/{id}", name="cancel")
     * @param $id
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function cancelOuting($id, EntityManagerInterface $em, Request $request)
    {

        // Récupération de la sortie
        $outingRepository = $em->getRepository(Outing::class);
        $outing = $outingRepository->find($id);

        $stateRepository = $em->getRepository(State::class);
        $outing->setState($state = $stateRepository->find('6'));

        $this->addFlash(
            'success',
            'Sortie annulée avec succès'
        );

        $em->persist($outing);
        $em->flush();

        return new JsonResponse([
            'status' => 'ok',
            'outing' => $outing,
        ]);

    }

    /**
     * @Route("edit/{id}", name="edit")
     *
     */
    public function editOuting($id, EntityManagerInterface $em, Request $request)
    {
        // Récupération de la sortie
        $outingRepository = $em->getRepository(Outing::class);
        $outing = $outingRepository->find($id);

        // Formulaire de modification de profil
        $outingForm = $this->createForm(OutingType::class, $outing);
        $outingForm->handleRequest($request);

        // Formulaire de modification de la place
        $place = $outing->getPlace();
        $placeForm = $this->createForm(PlaceType::class, $place);
        $placeForm->handleRequest($request);

        if($outingForm->isSubmitted()) {

            $outing->setClosingDate($outing->getLimitDateSub());

            $this->addFlash(
                'success',
                'Sortie modifiée avec succès'
            );

            $em->persist($outing);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render(
            'outing/edit.html.twig',
            [
                'outingFormView' => $outingForm->createView(),
                'placeFormView' => $placeForm->createView(),
            ]
        );
    }

}

