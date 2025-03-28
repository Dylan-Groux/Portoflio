<?php
namespace App\Controller;

use App\Form\ContactType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AccueilController
 *
 * @author emds
 */
class AccueilController extends AbstractController{

    
    #[Route('/', name: 'accueil')]
    public function index(Request $request): Response{

        $form = $this->createForm(ContactType::class);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // TODO: Ajoutez la logique d'envoi d'email ici
            // $this->addFlash('success', 'Formulaire de contact rempli avec succès !');

            $this->addFlash('info', 'En cours de développement, veuillez réessayer plus tard, ou me contacter à l\'adresse mail dylangroux2105@gmail.com');
    
            return $this->redirectToRoute('accueil');
        }

        return $this->render("pages/accueil.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    
    
    #[Route('/cgu', name: 'cgu')]
    public function cgu(): Response{
        return $this->render("pages/cgu.html.twig");
    }
}
