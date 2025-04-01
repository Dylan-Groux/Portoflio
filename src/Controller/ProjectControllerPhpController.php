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

    #[Route('/project/mesvoyages', name: 'mesvoyages')]
    public function mesVoyagesIndex(): Response
    {
        return $this->render('project_controller_php/mesvoyages.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }

    #[Route('/project/portfolio', name: 'portfolio')]
    public function monPortfolioIndex(): Response
    {
        return $this->render('project_controller_php/portfolio.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }

    #[Route('/project/smallcontact', name: 'smallcontact')]
    public function smallContactIndex(): Response
    {
        return $this->render('project_controller_php/smallcontact.html.twig', [
            'controller_name' => 'ProjectControllerPhpController',
        ]);
    }
}
