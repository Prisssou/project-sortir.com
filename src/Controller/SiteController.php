<?php

namespace App\Controller;

use App\Form\SiteType;
use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends Controller
{
    /**
     * @Route("/site", name="site")
     */
    public function addSite(EntityManagerInterface $em, Request $request)
    {
        $site = new Site();

        $siteForm = $this->createForm(SiteType::class, $site);
        $siteForm->handleRequest($request);

        if($siteForm->isSubmitted()) {

            $this->addFlash(
                'success',
                'Site ajouté avec succès'
            );
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('home');

        }

        return $this->render(
            'outing/sites.html.twig', [
            'siteFormView' => $siteForm->createView(),
        ]);
    }
}
