<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CollectionController extends Controller
{

    /**
     * @Route("collection", name="user_collection")
     */
    public function collectionAction(Request $request)
    {
        // On récupère la collection
        $collection = $this->getDoctrine()
            ->getRepository('AppBundle:CollectionItem')
            ->findCollection($this->getUser()->getId());

        $ranges = $collection['ranges'];
        $minifiguresCount = $collection['minifigures_count'];
        $setsCount = $collection['sets_count'];

        // On récupère les annonces en cours
        $offersList = $this->getDoctrine()
            ->getRepository('AppBundle:Offer')
            ->findBy(['user' => $this->getUser()->getId()]);

        // On présente les données avant de les passer à la vue

        // On affiche la page
        return $this->render(':user:collection.html.twig', [
            'ranges' => $ranges,
            'minifiguresCount' => $minifiguresCount,
            'setsCount' => $setsCount,
            'offersList' => $offersList,
        ]);
    }
}