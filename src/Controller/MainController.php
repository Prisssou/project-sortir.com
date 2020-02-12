<?php

namespace App\Controller;

use App\Form\FilterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {



        $filterForm = $this->createForm(FilterFormType::class);
        $filterForm->handleRequest($request);

        if ($filterForm->isSubmitted() && $filterForm->isValid()) {



            return $this->redirectToRoute("user_login");

        }


        return $this->render(
            'main/home.html.twig',
            [
                'MemberFormView' => $filterForm->createView(),
            ]
        );

        return $this->render('main/home.html.twig');
    }
}