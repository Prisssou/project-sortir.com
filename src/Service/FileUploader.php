<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class FileUploader
{
private $parameter;
    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }




    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->parameter, $fileName);
        } catch (FileException $e) {
            // TODO... handle exception if something happens during file upload
        }

        return $fileName;
    }

//    public function __construct()
//    {
//
//    }
//
//    public function upload(EntityManagerInterface $entityManager, Request $request)
//    {
//        $image = new Image();
//        $imageForm = $this->
//        $imageForm->handleRequest($request);
//
//        if ($imageForm->isSubmitted() && $imageForm->isValid()){
//
//            /**
//             * @var UploadedFile $imageFile
//             */
//            $imageFile = $imageForm->get('url')->getData();
//            dump($imageFile);
//            die();
//            $fileName = $this->generateUniqueFileName().'.'.$imageFile->guessExtension();
////          $fileName = $this->generateUniqueFileName().'.'.$imageFile->getMimeType();
//
//
////            dump($fileName);
////            die();
//
//            // Move the file to the directory where images are stored
//
//            $imageFile->move(
//                $this->getParameter('images_directory'),
//                $fileName
//            );
//
//            // updates the 'imageFilename' property to store the Images file name
//            // instead of its contents
//            $image->setUrl($fileName);
//
//
//            $this->addFlash(
//                'success',
//                'Votre image a été ajoutée avec succès!'
//            );
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($image);
//            $entityManager->flush();
//
////            return $this->redirectToRoute("home");
//        }
//
//        return $imageForm;
//
//
//
//    }
//    private function generateUniqueFileName()
//    {
//        return md5(uniqid());
//    }



}