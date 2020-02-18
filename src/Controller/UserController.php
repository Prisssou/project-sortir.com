<?php

namespace App\Controller;



use App\Entity\Image;
use App\Entity\Member;
use App\Entity\Outing;
use App\Form\MemberFormType;
use App\Form\ImageType;
use App\Form\MemberType;
use App\Service\FileUploader;
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
     * @Route("/profile{id}", name="profile", requirements={"id" : "\d+"} )
     */
    public function profil($id, EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $passwordEncoder, FileUploader $fileUploader): Response
    {
//        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {        }


        // Formulaire générale de gestion de profil
            // Récupération du membre par son id
            $memberRepository = $entityManager->getRepository(Member::class);
            $member = $memberRepository->find($id);
            dump($member);
            // Création du formulaire de mise à jour du profil
            $memberForm = $this->createForm(MemberType::class, $member);
            $memberForm->handleRequest($request);


            if ($memberForm->isSubmitted() && $memberForm->isValid()) {


                $entityManager = $this->getDoctrine()->getManager();
                $formData = $request->request->all();

                // Récupération de l'image
                $image = new Image();
                $imageFile = $memberForm['image']['url']->getData();
                $imageFileName = $fileUploader->upload($imageFile);
                $image->setUrl($imageFileName);

                // Hydratation de la la table Image de la BDD
                $entityManager->persist($image);
                $entityManager->flush();

                $member->setImage($image);
                $entityManager->persist($member);
                $entityManager->flush();

                return $this->redirectToRoute("home");
            }

            return $this->render(
                'user/profile.html.twig',
                [
                    'member' => $member,
                    'memberFormView' => $memberForm->createView(),

                ]
            );

        }

    /**
     * @Route("/otherProfile/{id}", name="other_profile")
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function displayProfile($id, EntityManagerInterface $entityManager, Request $request)
    {
        // Récupération de l'utilisateur
        $memberRepository = $entityManager->getRepository(Member::class);
        $member = $memberRepository->find($id);
        dump($member);



        return $this->render(
            'user/otherProfile.html.twig',
            compact('member')
        );

    }







}