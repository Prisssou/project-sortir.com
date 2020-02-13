<?php

namespace App\Controller;


use App\Data\SearchData;
use App\Entity\Outing;
use App\Entity\Site;
use App\Entity\State;
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
     */
    public function home(EntityManagerInterface $entityManager)
    {
        $sortieRepository = $entityManager->getRepository(Outing::class);
        $sorties = $sortieRepository->findAll();


//        $sortieMemberRepository = $entityManager->getRepository(Outing::class);
//        $sortiesMember = $sortieRepository->findAll();

        $siteRepository = $entityManager->getRepository(Site::class);
        $sites = $siteRepository->findAll();


        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $sortiesFiltered = $sortieRepository->findSearch();

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
                'form' => $form->createView(),
            ]
        );
    }

//    /**
//     * @Route("/outing{id}", name="detail", methods{'GET'})
//     */
//    public function detail(EntityManagerInterface $entityManager, Outing $outing) : Response
//    {
////        $id = $outing->getId();
////        $suscribersList = $entityManager->getRepository()->find($id);
//
//        return $this->render('outing/detailOuting.html.twig', compact('outing', 'suscribersList'));
//    }


}