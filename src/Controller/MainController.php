<?php

namespace App\Controller;


use App\Data\SearchData;
use App\Entity\Outing;
use App\Entity\Site;
use App\Entity\State;
use App\Entity\Subscription;
use App\Form\FilterFormType;
use App\Form\SearchFormType;
use App\Service\OutingWorkflowHandler;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Exception\LogicException;

class MainController extends Controller
{

    /**
     * Permet de changer le status d'une sortie
     * @Route("workflow/{status}/{id}", name="outing_workflow")
     * @param $status
     * @param Outing $outing
     * @param OutingWorkflowHandler $owh
     * @param Request $request
     * @return RedirectResponse
     */
    public function workflow($status,Outing $outing, OutingWorkflowHandler $owh, Request $request)
    {

        #Traitement du Workflow
        try {

            $owh->handle($outing,$status);

            #Notification
            $this->addFlash('notice','Le changement de statut a bien été effectué.');

        } catch (LogicException $e){
            #Notification
            $this->addFlash('error','Changement de statut impossible.');

        }

        #Vérification par dump
        dump($owh);

        #Récupération du redirect
        $redirect = $request->get('redirect') ?? 'home';

        # On redirige l'utilisateur sur la bonne page
        return $this->redirectToRoute($redirect);

    }


    /**
     * @Route("/", name="home")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function home(EntityManagerInterface $entityManager, Request $request)
    {
        $sortieRepository = $entityManager->getRepository(Outing::class);
        $sorties = $sortieRepository->findAll();


//        $sortieMemberRepository = $entityManager->getRepository(Outing::class);
//        $sortiesMember = $sortieRepository->findAll();

        $siteRepository = $entityManager->getRepository(Site::class);
        $sites = $siteRepository->findAll();

        $subRepository = $entityManager->getRepository(Subscription::class);
        $subscriptions = $subRepository->findAll();

        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);


        $userId= null;
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $userId = $this->getUser()->getId();
        }


        $sortiesFiltered = $sortieRepository->findSearch($data,$userId);
        $sorties = $sortiesFiltered;

//        dump($workflow);


//    dump($sorties);

//        $filterForm = $this->createForm(FilterFormType::class);
//        $filterForm->handleRequest($request);
//
//        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
//
//
//
//            return $this->redirectToRoute("user_login");
//
//        }
//
//
//        return $this->render(
//            'main/home.html.twig',
//            [
//                'MemberFormView' => $filterForm->createView(),
//            ]
//        );

        return $this->render(
            'main/home.html.twig',
            [
                'sorties' => $sorties,
                'sites' => $sites,
                'sortiesFiltered' => $sortiesFiltered,
                'subscriptions' => $subscriptions,
                'form' => $form->createView(),
            ]
        );
    }




}