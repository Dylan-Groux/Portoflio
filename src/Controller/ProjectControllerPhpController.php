<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectControllerPhpController extends AbstractController
{
    #[Route('/project/mediatekformation', name: 'mediatekformation')]
    public function mediatekFormationIndex(): Response
    {
        return $this->render('project_controller_php/index.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }
}
