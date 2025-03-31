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
        return $this->render('project_controller_php/mediatekformation.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }

    #[Route('/project/pdfgenerator', name: 'pdfgenerator')]
    public function pdfGeneratorIndex(): Response
    {
        return $this->render('project_controller_php/pdfgenerator.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }
}
