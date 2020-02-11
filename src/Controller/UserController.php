<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
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
     * Afficher la page de gestion du profil
     * @Route("/profil", name="create")
     */
    public function profil(EntityManagerInterface $entityManager, Request $request)
    {
        $member = new Member();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $member = $this->getMember();
            $member->setUser($member);
        }

        $memberForm = $this->createForm(MemberType::class, $article);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted()) {
            /**
             * @var UploadedFile $imageFile
             */
            $imageFile = $memberForm->get('image')->getData();

//            $imageFile = $article->getImage();
            /*            dump($imageFile);
                        dump($imageFile->getPathname());
                        die();*/

            $fileName = $this->generateUniqueFileName().'.'.$imageFile->guessExtension();
//          $fileName = $this->generateUniqueFileName().'.'.$imageFile->getMimeType();


//            dump($fileName);
//            die();

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
                'Article ajouté avec succès'
            );

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
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('user/hometest.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}