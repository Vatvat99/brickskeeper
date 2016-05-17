<?php

namespace AppBundle\Repository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

/**
 * OfferRepository
 */
class OfferRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Récupère une liste d'annonces
     */
    public function findOffers()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT ofr
                FROM AppBundle:Offer ofr
                LEFT JOIN ofr.user us
                LEFT JOIN us.userProfile us_pr
                LEFT JOIN ofr.offer_pictures ofr_pc
                ORDER BY ofr.submitted_at
            ')
            ->getResult();
    }

    /**
     * Récupère une liste d'annonces contenant un certain élément
     *
     * @param $itemType string Type de l'élément (minifigure|set)
     * @param $id int Id de l'élément
     */
    public function findOffersWithItem($itemType, $id)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT ofr
                FROM AppBundle:Offer ofr
                LEFT JOIN ofr.user us
                LEFT JOIN us.userProfile us_pr
                LEFT JOIN ofr.offer_pictures ofr_pc
                LEFT JOIN ofr.offer_items ofr_it
                WHERE ofr_it.' . $itemType . ' = :id
                ORDER BY ofr.submitted_at
            ')
            ->setParameter('id', $id)
            ->getResult();
    }

}
