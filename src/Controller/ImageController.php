<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends Controller
{
    /**
     * @Route("/image", name="image")
     */
    public function index()
    {
        return $this->render('image/addplace.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    /**
     * @Route("/image", name="image")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function upload(EntityManagerInterface $entityManager, Request $request)
    {
        $image = new Image();
        $imageForm = $this->createForm(ImageType::class, $image);
        $imageForm->handleRequest($request);

        if ($imageForm->isSubmitted() && $imageForm->isValid()){

            /**
             * @var UploadedFile $imageFile
             */
            $imageFile = $imageForm->get('image')->getData();
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
                'Votre image a été ajoutée avec succès!'
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render(
            'user/profile.html.twig',
            [
                'imageFormView' => $imageForm->createView(),
            ]
        );
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
