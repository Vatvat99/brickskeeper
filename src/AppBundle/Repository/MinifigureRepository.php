<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MinifigureRepository
 */
class MinifigureRepository extends EntityRepository
{

    /**
     * Récupère l'ensemble des figurines d'une série
     * @param $serieId Id de la série
     */
    public function findMinifiguresFromSerie($serieId)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT mf.id AS id,
                    mf.name AS name, 
                    mf.slug AS slug, 
                    mf.picture AS picture, 
                    SUM(CASE WHEN ofr.type LIKE \'%Vente%\' THEN 1 ELSE 0 END) AS sell_total, 
                    SUM(CASE WHEN ofr.type LIKE \'%Echange%\' THEN 1 ELSE 0 END) AS exchange_total, 
                    MIN(ofr.price) AS price
                FROM AppBundle:Minifigure mf
                INNER JOIN mf.serie sr
                LEFT JOIN mf.offer_items ofr_it
                LEFT JOIN ofr_it.offer ofr
                WHERE sr.id = :id
                GROUP BY mf.id
                ORDER BY mf.id
            ')
            ->setParameter('id', $serieId)
            ->getArrayResult();
    }

    /**
     * Cherche en bdd la figurine correspondant à un id donné
     * @param int $minifigureId Id de la figurine
     */
    public function findMinifigure($minifigureId)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT mf.id AS id, 
                    mf.name AS name, 
                    mf.slug AS slug, 
                    mf.picture AS picture, 
                    mf.release_year AS release_year, 
                    sr.id AS serie_id, 
                    sr.name AS serie_name, 
                    st.number AS set_number, 
                    st.name AS set_name, 
                    rg.id AS range_id, 
                    rg.name AS range_name
                FROM AppBundle:Minifigure mf
                LEFT JOIN mf.minifigure_sets mf_st
                LEFT JOIN mf_st.set st
                LEFT JOIN mf.serie sr
                LEFT JOIN sr.range rg
                WHERE mf.id = :id
            ')
            ->setParameter('id', $minifigureId)
            ->getSingleResult();
    }

}
