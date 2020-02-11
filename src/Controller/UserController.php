<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/",name="user_")
 */
class UserController extends Controller
{



    /**
     * @Route("/login", name="login")
     * @param $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);

    }

    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('user/hometest2.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/main", name="main")
     */
    public function main()
    {
        return $this->render('user/hometest.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

}