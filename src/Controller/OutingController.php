<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Outing;
use App\Entity\State;
use App\Entity\Place;
use App\Entity\Subscribed;
use App\Entity\Subscription;
use App\Form\OutingType;
use App\Form\SubscribedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    // Afficher un sortie

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


        return $this->render(
            'outing/detailOuting.html.twig',
            compact('outing')
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

        // Récuparation de l'utilisateur courant
        $user = $this->getUser();


        $subscription = new Subscription();
        $subscription->setMember($user);
        $subscription->setOuting($outing);
        $subscription->setSubDate(new \DateTime('now'));

        $entityManager->persist($subscription);
        $entityManager->flush();

        $this->addFlash('success', 'Votre inscription a bien été prise en compte !');

        return $this->redirectToRoute('home');

    }

    // Se désinscrire d'une sortie

    /**
     * @Route("/unsubscribe/{id}", name="unsubscribe")
     * @param Outing $outing
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function cancelSubscription(Outing $outing, EntityManagerInterface $entityManager, Request $request)
    {

        $member = $this->getMember();
        $member->removeOuting($outing);
        $outing->removeSubscribed($member);
        $entityManager->persist();
        $entityManager->flush();


        $this->addFlash('success', 'Votre annulation a bien été prise en compte');
        return $this->render($this->generateUrl('home'));

    }


}

