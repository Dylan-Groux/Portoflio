<?php
namespace App\Controller;

use App\Form\ContactType;
use App\Repository\FormationRepository;
use Psr\Log\LoggerInterface;
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
    public function index(Request $request, MailerInterface $mailer, LoggerInterface $logger): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
        dump('Formulaire soumis');
        if ($form->isValid()) {
            dump('Formulaire valide');
            // envoi mail...
        } else {
            dump('Formulaire invalide');
            dump($form->getErrors(true));
        }
        } else {
            dump('Formulaire non soumis');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from('admin@portfolio.grdy2507.odns.fr')
                ->replyTo($data['email'])
                ->to('admin@portfolio.grdy2507.odns.fr')
                ->subject($data['subject'])
                ->text(
                    "Nom : " . $data['name'] . "\n" .
                    "Email : " . $data['email'] . "\n" .
                    "Téléphone : " . $data['phone'] . "\n\n" .
                    "Message : \n" . $data['message']
                );

            try {
                $mailer->send($email);
                $this->addFlash('info', 'Votre message a bien été envoyé. Merci !');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de l’envoi du mail : ' . $e->getMessage());
                // Log l'erreur (utile en prod)
                $logger->error('Mailer error: ' . $e->getMessage());
            }

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

    #[Route('/test-mail', name: 'test_mail')]
public function testMail(MailerInterface $mailer, LoggerInterface $logger): Response
{
    // Données "en dur" simulant ce que le formulaire devrait envoyer
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '0123456789',
        'subject' => 'Test sujet',
        'message' => 'Ceci est un message de test.'
    ];

    // Construction du mail (même code que pour le formulaire)
    $email = (new Email())
        ->from('admin@portfolio.grdy2507.odns.fr')
        ->replyTo($data['email'])
        ->to('admin@portfolio.grdy2507.odns.fr')
        ->subject($data['subject'])
        ->text(
            "Nom : " . $data['name'] . "\n" .
            "Email : " . $data['email'] . "\n" .
            "Téléphone : " . $data['phone'] . "\n\n" .
            "Message : \n" . $data['message']
        );

        try {
            $mailer->send($email);
            $this->addFlash('info', 'Mail de test envoyé avec succès !');
        } catch (\Exception $e) {
            $logger->error('Erreur lors de l’envoi du mail de test : ' . $e->getMessage());
            $this->addFlash('error', 'Erreur lors de l’envoi du mail de test : ' . $e->getMessage());
        }

        return $this->redirectToRoute('accueil');
    }

}
