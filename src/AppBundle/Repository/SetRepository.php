<?php

namespace AppBundle\Repository;

/**
 * SetRepository
 */
class SetRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Récupère l'ensemble des sets d'une série
     * @param $serieId Id de la série
     */
    public function findSetsFromSerie($serieId)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT st.id AS id,
                    st.name AS name, 
                    st.slug AS slug, 
                    st.picture AS picture, 
                    SUM(CASE WHEN ofr.type LIKE \'%Vente%\' THEN 1 ELSE 0 END) AS sell_total, 
                    SUM(CASE WHEN ofr.type LIKE \'%Echange%\' THEN 1 ELSE 0 END) AS exchange_total, 
                    MIN(ofr.price) AS price
                FROM AppBundle:Set st
                INNER JOIN st.serie sr
                LEFT JOIN st.offer_items ofr_it
                LEFT JOIN ofr_it.offer ofr
                WHERE sr.id = :id
                GROUP BY st.id
                ORDER BY st.id
            ')
            ->setParameter('id', $serieId)
            ->getArrayResult();
    }

    /**
     * Cherche en bdd le set correspondant à un id donné
     * @param int $setId Id du set
     */
    public function findSet($setId)
    {
        // Sélection du set correspondant à l'id
        $result = $this->getEntityManager()
            ->createQuery('
                SELECT st.id AS id, 
                    st.number AS number, 
                    st.name AS name, 
                    st.slug AS slug, 
                    st.picture AS picture, 
                    st.release_year AS release_year, 
                    st.price AS price, 
                    sr.id AS serie_id, 
                    sr.name AS serie_name, 
                    rg.id AS range_id, 
                    rg.name AS range_name
                FROM AppBundle:Set st
                LEFT JOIN st.serie sr
                LEFT JOIN sr.range rg
                WHERE st.id = :id
            ')
            ->setParameter('id', $setId)
            ->getSingleResult();

        // Et on récupère les figurines associées à ce set
        $result_minifigures = $this->getEntityManager()
            ->createQuery('
                SELECT mf.id AS id
                FROM AppBundle:Minifigure mf
                LEFT JOIN mf.minifigure_sets mf_st
                WHERE mf_st.set = :id
            ')
            ->setParameter('id', $setId)
            ->getArrayResult();

        // Présentation des données dans un array imbriqué
        $result['minifigures_id'] = [];
        foreach ($result_minifigures as $minifigure) {
            $result['minifigures_id'][] = $minifigure['id'];
        }
        
        return $result;
    }

}
