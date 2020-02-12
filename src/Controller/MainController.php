<?php

namespace App\Controller;


use App\Entity\Outing;
use App\Form\FilterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        return $this->render('main/home.html.twig', compact('sorties'));
    }
}