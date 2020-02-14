<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use App\Entity\Ville;


class APIController extends Controller
{
    /**
     * @Route("/addAPI", name="add_ville", methods={"GET"})
     */
    public function liste(EntityManagerInterface $entityManager)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/44/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville44 = (json_decode($json, true));


        foreach ($ville44 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/29/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville29 = (json_decode($json, true));


        foreach ($ville29 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/35/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville35 = (json_decode($json, true));


        foreach ($ville35 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/53/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville53 = (json_decode($json, true));


        foreach ($ville53 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/72/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville72 = (json_decode($json, true));


        foreach ($ville72 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/49/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville49 = (json_decode($json, true));


        foreach ($ville49 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/85/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville85 = (json_decode($json, true));


        foreach ($ville85 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/79/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville79 = (json_decode($json, true));


        foreach ($ville79 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        $response = $client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/56/communes?fields=nom,code,codesPostaux,departement&format=json&geometry=centre',
            [
                'proxy' => [
                    'http' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                    'https' => 'http://proxy-sh.ad.campus-eni.fr:8080',
                ], 'verify' => false
            ]
        );
        $json = $response->getBody();
        $ville56 = (json_decode($json, true));


        foreach ($ville56 as $v)
        {
            $ville = new Ville();
            $ville->setNom($v['nom']);
            $ville->setCode($v['code']);
            $ville->setcodesPostaux($v['codesPostaux'][0]);
            $ville->setCodeDepartement($v['departement']['code']);
            $ville->setDepartement($v['departement']['nom']);

            $entityManager->persist($ville);
            $entityManager->flush();

        }

        return $this->render(
            'main/home.html.twig',
            [
                'controller_name' => 'APIController',
            ]
        );
    }
}
