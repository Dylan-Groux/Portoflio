<?php
namespace App\Controller;

use App\Form\ContactType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Description of AccueilController
 *
 * @author emds
 */
class AccueilController extends AbstractController{


    public function redirectToAccueil(): Response{
        $url = $this->generateUrl('accueil') . '#contact';
        return new RedirectResponse($url);
    }
    
    #[Route('/', name: 'accueil')]
    public function index(Request $request, MailerInterface $mailer): Response{

        $form = $this->createForm(ContactType::class);
    
        $form->handleRequest($request);
    
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Construction du mail
            $email = (new Email())
                ->from($data['email']) // l'expéditeur : le champ du formulaire
                ->to('admin@portfolio.grdy2507.odns.fr') // le destinataire final
                ->subject($data['subject'])
                ->text(
                    "Nom : " . $data['name'] . "\n" .
                    "Email : " . $data['email'] . "\n" .
                    "Téléphone : " . $data['phone'] . "\n\n" .
                    "Message : \n" . $data['message']
                );

            // Envoi du mail
            $mailer->send($email);

            // Ajout d’un message flash de confirmation
            $this->addFlash('info', 'Votre message a bien été envoyé. Merci !');

            // Redirection pour éviter le re-post en cas de rafraîchissement
            $url = $this->generateUrl('accueil') . '#contact';
            return new RedirectResponse($url);
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
