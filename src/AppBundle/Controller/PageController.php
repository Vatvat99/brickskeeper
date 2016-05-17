<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ContactType;

class PageController extends Controller
{

    /**
     * @Route("/page/contact", name="page_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        // On prépare le formulaire de contact
        $form = $this->createForm(ContactType::class, null);

        $form->handleRequest($request);

        // Si le formulaire a été posté
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données
            $data = $form->getData();
            // Et on envoie le mail
            $session = $request->getSession();
            if ($this->sendContactEmail($data)) {
                $session->getFlashBag()->add('success', 'Votre message a bien été envoyé');
            } else {
                $session->getFlashBag()->add('error', 'Votre message n\'a pas pu être envoyé');
            }
        }

        return $this->render(':page:contact.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * Envoi le mail de contact
     * @param $data Données provenant du formulaire
     * @return int
     */
    private function sendContactEmail($data)
    {
        // On prépare le mail...
        $message = \Swift_Message::newInstance()
            ->setSubject($this->getParameter('app_name') . ' - Un visiteur vient de vous envoyer un message')
            ->setFrom($data['email'])
            ->setTo($this->getParameter('email_webmaster'))
            ->setBody(
                $this->renderView(':page/emails:contact.html.twig', ['data' => $data]), 'text/html'
            )->addPart(
                $this->renderView(':page/emails:contact.txt.twig', ['data' => $data]), 'text/plain'
            );

        // ... et on l'envoie
        return $this->get('mailer')->send($message);
    }
    
}