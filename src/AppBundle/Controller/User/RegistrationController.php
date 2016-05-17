<?php
namespace AppBundle\Controller\User;

use AppBundle\Entity\User;
use AppBundle\Form\Type\User\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request)
    {
        // On construit le formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // On gère l'envoi
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Encode le mot de passe @todo Passer par un listener Doctrine ?
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // On définit le token pour la validation du compte
            $activationKey = base64_encode(random_bytes(20));
            $user->setActivationKey($activationKey);

            // On définit la date de création du compte
            $registrationDate = new \DateTime();
            $user->setRegistrationDate($registrationDate);

            // On vérifie que l'email n'est pas déjà utilisé par un autre utilisateur
            $em = $this->getDoctrine()->getManager();
            // $user = $em->getRepository('AppBundle:User')->checkIfExists(['email' => $email]);

            try {
                // On enregistre l'utilisateur
                $em->persist($user);
                $em->flush();

                // On envoi le mail de confirmation d'inscription
                $this->sendConfirmationEmail($user);

                // On affiche le message de confirmation
                return $this->render(':user/registration:confirm.html.twig', [
                    'user' => $user
                ]);
            } catch(UniqueConstraintViolationException $e) {
                // On affiche un message d'erreur
                $session = $request->getSession();
                $session->getFlashBag()->add('error', 'Cette adresse e-mail est déjà utilisée par un membre.');
            }

        }

        // On affiche le formulaire
        return $this->render(':user/registration:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/activate/{email}/{activationKey}", name="user_activate")
     * @todo Validation pour les paramètres de l'url ?
     */
    public function activate($email, $activationKey, Request $request)
    {
        // On récupère l'utilisateur
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['email' => $email]);

        if (!$user) {
            $message = 'error';
        } elseif ($user->isActive()) {
            $message = 'already-active';
        } else {
            // On active le compte
            $user->setActive(true);
            $em->persist($user);
            $em->flush();
            $message = 'active';
        }

        // On affiche la page de confirmation
        return $this->render(':user/registration:activation.html.twig', [
            'message' => $message,
        ]);

    }

    /**
     * Envoi le mail de confirmation suite à l'inscription sur le site
     * @param User $user
     */
    private function sendConfirmationEmail(User $user)
    {
        // On prépare le mail...
        $message = \Swift_Message::newInstance()
            ->setSubject($this->getParameter('app_name') . ' - Confirmation de votre adresse e-mail')
            ->setFrom($this->getParameter('smtp_email'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(':user/registration/emails:register_confirm.html.twig', ['user' => $user]), 'text/html'
            )->addPart(
                $this->renderView(':user/registration/emails:register_confirm.txt.twig', ['user' => $user]), 'text/plain'
            );

        // ... et on l'envoie
        $this->get('mailer')->send($message);
    }

}