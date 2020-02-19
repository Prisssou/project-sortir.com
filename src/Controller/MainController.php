<?php

namespace App\Controller;


use App\Data\SearchData;
use App\Entity\Outing;
use App\Entity\Site;
use App\Entity\State;
use App\Entity\Subscription;
use App\Form\FilterFormType;
use App\Form\SearchFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
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