<?php
namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use AppBundle\Entity\User;
use AppBundle\Form\Type\User\ForgottenPassword\ForgottenType;
use AppBundle\Form\Type\User\ForgottenPassword\RegenerateType;
use AppBundle\Form\Type\User\UserEditType;
use AppBundle\Form\Type\User\ContactType;
use AppBundle\Form\Type\User\SearchType;

class UserController extends Controller
{
    /**
     * @Route("/login", name="user_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier nom d'utilisateur entré par l'utilisateur
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render(':user:login.html.twig', [
            'lastEmail' => $lastEmail,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function logoutAction(Request $request)
    {

    }

    /**
     * @Route("/forgotten-password", name="user_forgotten_password")
     */
    public function forgottenPaswordAction(Request $request)
    {
        $form = $this->createForm(ForgottenType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // On récupère le membre correspondant à l'email
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['email' => $data['email']]);

            if ($user) {
                // On envoie un mail pour vérifier la validité de la demande
                $this->sendForgottenPasswordEmail($user);

                // Et on affiche la page de confirmation
                return $this->render(':user/forgotten-password:confirm.html.twig', [
                    'user' => $user,
                ]);
            } else {
                $this->addFlash('error', 'Cette adresse e-mail n\'est utilisée par aucun membre.');
            }
        }

        // On affiche le formulaire
        return $this->render(':user/forgotten-password:forgotten_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/regenerate-password/{email}/{activationKey}", name="user_regenerate_password")
     * @todo Validation pour les paramètres de l'url ?
     */
    public function regeneratePasswordAction($email, $activationKey, Request $request)
    {
        // On récupère l'utilisateur correspondant à l'email
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy(['email' => $email]);

        // Si on a aucun utilisateur pour cet email ou que la clé ne correspond pas
        if (!$user || $user->getActivationKey() != $activationKey) {
            throw new UsernameNotFoundException();
        }

        // On construit le formulaire
        $form = $this->createForm(RegenerateType::class, $user);
        $form->handleRequest($request);

        // Si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On modifie le mot de passe de ce membre
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // On enregistre
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Si le compte est bien activé
            if ($user->isActive()) {
                
                // On connecte directement l'utilisateur
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $event = new InteractiveLoginEvent($request, $token);
                $this->get('event_dispatcher')->dispatch('security.interactive_login', $event);

                // Puis on redirige vers la page de profil
                return $this->redirectToRoute('user_profile', [
                    'id' => $user->getId(),
                ]);
            }
        }

        // On affiche le formulaire
        return $this->render(':user/forgotten-password:regenerate_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Envoi le mail suite à la demande de réinitialisation du mot de passe
     * @param User $user
     */
    private function sendForgottenPasswordEmail(User $user)
    {
        // On prépare le mail...
        $message = \Swift_Message::newInstance()
            ->setSubject($this->getParameter('app_name') . ' - Mot de passe oublié')
            ->setFrom($this->getParameter('smtp_email'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(':user/forgotten-password/emails:forgotten_password.html.twig', ['user' => $user]), 'text/html'
            )->addPart(
                $this->renderView(':user/forgotten-password/emails:forgotten_password.txt.twig', ['user' => $user]), 'text/plain'
            );

        // ... et on l'envoie
        $this->get('mailer')->send($message);
    }

    /**
     * Affiche le profil des utilisateurs
     *
     * @Route("/user/{id}", defaults={"id" = null}, requirements={"id": "\d+"}, name="user_profile")
     */
    public function profileAction($id, Request $request)
    {
        // On recherche l'utilisateur correspondant à l'id
        if (is_null($id)) {
            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                throw $this->createAccessDeniedException();
            }
            $user = $this->getUser();
        } else {
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        }

        // var_dump($user); die;

        // Si aucun utilisateur n'a été trouvé, on affiche une erreur
        if (!$user) {
            throw new UsernameNotFoundException();
        }

        // On a trouvé un utilisateur, on affiche la page correspondante

        // Si l'utilisateur, c'est la personne connectée au site
        // on affiche la version du profil correspondant
        if (is_null($id)) {

            // @todo gestion du formulaire de recherche de membre
            // ...

            // On prépare le formulaire de contact
            $form = $this->createForm(SearchType::class, null);
            $form->handleRequest($request);

            // Si le formulaire a été soumis et est valide
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                // On recherche un utilisateur correspondant à l'email
                $searchedUser = $this->getDoctrine()
                    ->getRepository('AppBundle:User')
                    ->findOneBy(['email' => $data['email']]);

                if ($searchedUser) {
                    return $this->redirectToRoute('user_profile', [
                        'id' => $searchedUser->getId()
                    ]);
                } else {
                    $session = $request->getSession();
                    $session->getFlashBag()->add('error', 'Aucun membre n\'a été trouvé');
                }
            }

            // On affiche la page
            return $this->render(':user/my-profile:view.html.twig', [
                'user' => $user,
                'form' =>$form->createView()
            ]);

        }
        // Si l'utilisateur c'est quelqu'un d'autre
        // on affiche la version du profil correspondant
        else {
            // On récupère la collection
            $collection = $this->getDoctrine()
                ->getRepository('AppBundle:CollectionItem')
                ->findCollection($user->getId());

            $ranges = $collection['ranges'];
            $minifiguresCount = $collection['minifigures_count'];
            $setsCount = $collection['sets_count'];

            // On affiche la page
            return $this->render(':user:profile.html.twig', [
                'user' => $user,
                'ranges' => $ranges,
                'minifiguresCount' => $minifiguresCount,
                'setsCount' => $setsCount,
            ]);

        }

    }

    /**
     * @Route("/user/edit", name="user_edit")
     */
    public function editAction(Request $request)
    {
        // On vérifie que l'utilisateur est bien connecté avant de le récupérer
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        
        // Fixe un faux password car ce champ est obligatoire et n'est pas présent dans le formulaire
        $user->setPlainPassword('plop');
        
        // On construit le formulaire
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        // Si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On vérifie si on veut supprimer l'image
            $deletePicture = $form->get('deletePicture')->getData();
           if ($deletePicture) {
               $this->get('vich_uploader.upload_handler')->remove($user->getUserProfile(), 'file');
           }
            // On enregistre
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        // On affiche la page
        return $this->render(':user/my-profile:edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("user/{id}/contact", name="user_contact")
     * @param Request $request
     */
    public function contactAction(Request $request, $id)
    {
        // On récupère l'utilisateur qu'on souhaite contacter
        $contactedUser = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        // Si aucun utilisateur n'a été trouvé, on affiche une erreur
        if (!$contactedUser) {
            throw new UsernameNotFoundException();
        }

        // On vérifie que l'utilisateur est bien connecté avant de le récupérer
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
        $contactingUser = $this->getUser();

        // On prépare le formulaire de contact
        $form = $this->createForm(ContactType::class, null);
        $form->handleRequest($request);

        // Si le formulaire a été posté
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données
            $data = $form->getData();
            // Et on envoie le mail
            $session = $request->getSession();
            if ($this->sendContactEmail($data, $contactingUser, $contactedUser)) {
                $session->getFlashBag()->add('success', 'Votre message a bien été envoyé');
            } else {
                $session->getFlashBag()->add('error', 'Votre message n\'a pas pu être envoyé');
            }
        }

        // On affiche la page
        return $this->render(':user:contact.html.twig', [
            'contactedUser' => $contactedUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Envoi le mail de contact
     * @param $data Données provenant du formulaire
     * @param $contactingUser User Utilisateur qui contact
     * @param $contactedUser User Utilisateur contact
     * @return int
     */
    private function sendContactEmail($data, $contactingUser,  $contactedUser)
    {
        // On prépare le mail...
        $message = \Swift_Message::newInstance()
            ->setSubject($this->getParameter('app_name') . ' - Un membre vient de vous envoyer un message')
            ->setFrom($this->getParameter('smtp_email'))
            ->setTo($contactedUser->getEmail())
            ->setBody(
                $this->renderView(':user/emails:contact.html.twig', [
                    'data' => $data,
                    'contactingUser' => $contactingUser
                ]), 'text/html'
            )->addPart(
                $this->renderView(':user/emails:contact.txt.twig', [
                    'data' => $data,
                    'contactingUser' => $contactingUser
                ]), 'text/plain'
            );

        // ... et on l'envoie
        return $this->get('mailer')->send($message);
    }

}
