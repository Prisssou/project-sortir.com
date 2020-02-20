<?php


namespace App\Service;


use App\Entity\Outing;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class OutingWorkflowHandler
{

    private $workflows, $manager;

    public function __construct(Registry $workflows, ObjectManager $manager)
    {
        $this->workflows = $workflows;
        $this->manager = $manager;
    }

    public function handle(Outing $outing, string $status): void
    {
        # Récupération du Workflow
        $workflow = $this->workflows->get($outing);

        dump($workflow);
        # Récupération de Doctrine
        $em = $this->manager;

        # Changement du Workflow
        $workflow->apply($outing, $status);

        # Insertion en BDD
        $em->flush();

        # Publication de l'article si possible
//        if ($workflow->can($outing, 'to_be_published')) {
//            $workflow->apply($outing, 'to_be_published');
//            $em->flush();
//        }
    }

}