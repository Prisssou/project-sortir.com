<?php

namespace App\Controller;


use App\Entity\Member;
use App\Form\MemberFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/",name="user_")
 */
class UserController extends Controller
{

    /**
     * @Route("/signup", name="signup")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signinUp(Request $request,  UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $member = new Member();
        $memberForm = $this->createForm(MemberFormType::class,$member);
        $memberForm->handleRequest($request);

        if($memberForm->isSubmitted() && $memberForm->isValid()){
            $this->addFlash('success','Ce compte a bien été enregistré!');
            $member->setPassword($passwordEncoder->encodePassword(
                $member,
                $memberForm->get('plainPassword')->getData()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute("user_login");

        }



        return $this->render('user/register.html.twig', [
            'accountFormView' => $memberForm->createView()
        ]);
    }


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