<?php

namespace App\Controller;



use App\Entity\Member;
use App\Form\MemberFormType;
use App\Form\MemberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

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
    public function signinUp(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $member = new Member();
        $memberForm = $this->createForm(MemberFormType::class, $member);
        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $this->addFlash('success', 'Ce compte a bien été enregistré!');
            $member->setPassword(
                $passwordEncoder->encodePassword(
                    $member,
                    $memberForm->get('plainPassword')->getData()
                )
            );
            $member->setActive(1);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute("user_login");

        }


        return $this->render(
            'user/register.html.twig',
            [
                'MemberFormView' => $memberForm->createView(),
            ]
        );
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

        return $this->render(
            'user/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );

    }

    /**
     * Afficher la page de gestion du profil
     * @Route("/profile{id}", name="profile" )
     */
    public function profil($id, EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
//        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {        }

//        // Récupération du membre par son id
        $memberRepository = $entityManager->getRepository(Member::class);
        $member = $memberRepository->find($id);

//        // Récupération de l'image par son id
//        $imageRepository = $entityManager->getRepository(Image::class);
//        $image = $imageRepository->find($id);

        // Création du formulaire de mise à jour du profil
        $memberForm = $this->createForm(MemberType::class, $member);
        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            /**
             * @var UploadedFile $imageFile
             */
            $imageFile = $memberForm->get('image')->getData();
//            dump($imageFile);
//            die();
            $fileName = $this->generateUniqueFileName().'.'.$imageFile->guessExtension();
//          $fileName = $this->generateUniqueFileName().'.'.$imageFile->getMimeType();


            dump($fileName);
            die();

            // Move the file to the directory where images are stored

            $imageFile->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // updates the 'imageFilename' property to store the Images file name
            // instead of its contents
            $member->setImage($fileName);


            $this->addFlash(
                'success',
                'La mise à jour du profil a été faite avec succès!'
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render(
            'user/profile.html.twig',
            [
                'memberFormView' => $memberForm->createView(),
            ]
        );

    }





    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render(
            'user/hometest2.html.twig',
            [
                'controller_name' => 'UserController',
            ]
        );
    }

    /**
     * @Route("/main", name="main")
     */
    public function main()
    {
        return $this->render(
            'user/hometest.html.twig',
            [
                'controller_name' => 'UserController',
            ]
        );
    }

}