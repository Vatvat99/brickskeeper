<?php

namespace AppBundle\Controller;

use Doctrine\ORM\NoResultException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;

class OfferController extends Controller
{

    /**
     * @Route("/offers/{page}", defaults={"page" = 1},
     *     requirements={"page": "\d+"}, name="offers_listing")
     */
    public function listingAction(Request $request, $page)
    {
        // On récupère la liste complète des annonces
        $offersResult = $this->getDoctrine()
            ->getRepository('AppBundle:Offer')
            ->findOffers();
        
        // On pagine
        $paginator  = $this->get('knp_paginator');
        $offersList = $paginator->paginate(
            $offersResult,
            $page,
            Offer::NUM_ITEMS
        );

        return $this->render(':offer:listing.html.twig', [
            'offersList' => $offersList,
        ]);
    }

    /**
     * @Route("/offers/{itemType}/{id}/{page}", defaults={"page" = 1},
     *     requirements={"itemType": "minifigure|set", "id": "\d+", "page": "\d+"}, name="offers_listing_item")
     */
    public function listingItemAction(Request $request, $itemType, $id, $page)
    {
        $item = '';

        // On récupère les informations de l'élément qu'on consulte
        if ($itemType == 'minifigure') {
            $item = $this->getDoctrine()
                ->getRepository('AppBundle:Minifigure')
                ->findMinifigure($id);
        }
        if ($itemType == 'set') {
            $item = $this->getDoctrine()
                ->getRepository('AppBundle:Set')
                ->findSet($id);
        }
        $item['type'] = $itemType;

        // On récupère la liste des annonces contenant cet élément
        $offersResult = $this->getDoctrine()
            ->getRepository('AppBundle:Offer')
            ->findOffersWithItem($itemType, $id);

        // On pagine
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $offersResult,
            $page,
            Offer::NUM_ITEMS
        );



        return $this->render(':offer:listing.html.twig', [
            'item' => $item,
            'offersList' => $pagination,
        ]);
    }

    /**
     * @Route("/offer/{id}", name="offer_view", requirements={"id": "\d+"})
     */
    public function viewAction(Request $request, $id)
    {
        // On recherche l'annonce correspondant à l'id
        $offer = $this->getDoctrine()
            ->getRepository('AppBundle:Offer')
            ->find($id);

        // On recherche les autres annonces du membre
        $otherOffers = $this->getDoctrine()
            ->getRepository('AppBundle:Offer')
            ->findBy(
                ['user' => $offer->getUser()],
                ['submitted_at' => 'desc']
            );
        
        return $this->render(':offer:view.html.twig', [
            'offer' => $offer, 
            'otherOffers' => $otherOffers, 
        ]);

    }

    /**
     * @Route("/offer/add", name="offer_add")
     */
    public function addAction(Request $request)
    {
        // On prépare le formulaire
        $offer = new Offer;
        $form = $this->createForm('AppBundle\Form\Type\Offer\OfferType', $offer);
        $form->handleRequest($request);

        // Si le formulaire a été posté
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($form->getData());
        }
        
        return $this->render(':offer:add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/offer/edit/{id}", name="offer_edit")
     */
    public function editAction(Request $request, $id)
    {

    }

    /**
     * @Route("/offer/delete/{id}", name="offer_delete")
     */
    public function deleteAction(Request $request, $id)
    {

    }

}