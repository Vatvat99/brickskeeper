<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CollectionItemRepository
 */
class CollectionItemRepository extends EntityRepository
{

    /**
     * Récupère la collection d'un utilisateur
     * @param $userId int Id de l'utilisateur
     */
    public function findCollection($userId)
    {
        $ranges = [];
        $previousRange = '';
        $previousSerie = '';
        $minifiguresCount = 0;
        $setsCount = 0;
        // On récupère les figurines
        $minifiguresResult = $this->findAllMinifiguresFromCollection($userId);

        // Et on les trie
        foreach ($minifiguresResult as $minifigureResult) {
            // Si il y a une nouvelle gamme, on la récupère
            if ($minifigureResult['range_id'] != $previousRange) {
                // Si une gamme existe (les infos d'une gamme ont déjà été récupérées)
                if (isset($range)) {
                    // On la rajoute à la liste des gammes
                    $ranges[$range['id']] = $range;
                }
                // On récupère les infos de la nouvelle gamme
                $range = [];
                $range['id'] = $minifigureResult['range_id'];
                $range['name'] = $minifigureResult['range_name'];
                $range['color'] = $minifigureResult['range_color'];
                // On initialise le nombre de figurines présentes dans cette gamme
                $range['minifigures_count'] = 0;
                // On crée le tableau qui va contenir la liste des séries
                $range['series'] = [];
                // Et on enregistre l'id
                $previousRange = $minifigureResult['range_id'];
            }

            // Si cette gamme contient une nouvelle série, on la récupère
            if ($minifigureResult['serie_id'] != $previousSerie) {
                // On récupère les infos de la série
                $serie = [];
                $serie['id'] = $minifigureResult['serie_id'];
                $serie['name'] = $minifigureResult['serie_name'];
                // On initialise le nombre de figurines présentes dans cette série
                $serie['minifigures_count'] = 0;
                // On crée le tableau qui va contenir la liste des figurines
                $serie['minifigures'] = [];
                // On l'ajoute à la liste
                $range['series'][$serie['id']] = $serie;
                // Et on enregistre l'id
                $previousSerie = $minifigureResult['serie_id'];
            }
            // On récupère les infos de la figurine
            $minifigure = [];
            $minifigure['id'] = $minifigureResult['id'];
            $minifigure['name'] = $minifigureResult['name'];
            $minifigure['slug'] = $minifigureResult['slug'];
            $minifigure['picture'] = $minifigureResult['picture'];
            $minifigure['release_year'] = $minifigureResult['release_year'];
            $minifigure['count'] = $minifigureResult['item_count'];
            $minifigure['sell_total'] = $minifigureResult['sell_total'];
            $minifigure['exchange_total'] = $minifigureResult['exchange_total'];
            $minifigure['price'] = $minifigureResult['price'];
            // On l'ajoute à la liste
            $range['series'][$serie['id']]['minifigures'][$minifigure['id']] = $minifigure;
            // Et on met à jour les nombres de figurines
            $range['minifigures_count'] += $minifigure['count'];
            $range['series'][$serie['id']]['minifigures_count'] += $minifigure['count'];
            $minifiguresCount += $minifigure['count'];
        }
        // Lorsqu'on a fini de parcourir les figurines, si une gamme existe
        if (isset($range)) {
            // On n'oublie pas de la rajouter à la liste des gammes
            $ranges[$range['id']] = $range;
        }

        // On réinitialise les variables
        $previousRange = '';
        $previousSerie = '';

        // On récupère les sets
        $setsResult = $this->findAllSetsFromCollection($userId);
        // Et on les trie
        foreach ($setsResult as $setResult) {
            // Si il y a une nouvelle gamme
            if ($setResult['range_id'] != $previousRange) {
                // Si une gamme existe (les infos d'une gamme ont déjà été récupérées)
                if (isset($range)) {
                    // On la rajoute à la liste des gammes
                    $ranges[$range['id']] = $range;
                }
                // Si on n'a pas récupéré la nouvelle gamme pour les figurines
                if (!array_key_exists($setResult['range_id'], $ranges)) {
                    // On récupère les infos de la nouvelle gamme
                    $range = [];
                    $range['id'] = $setResult['range_id'];
                    $range['name'] = $setResult['range_name'];
                    $range['color'] = $setResult['range_color'];
                    // On initialise le nombre de sets présents dans cette gamme
                    $range['sets_count'] = 0;
                    // On crée le tableau qui va contenir la liste des séries
                    $range['series'] = [];
                }
                // La gamme a déjà été récupérée avec les figurines
                else {
                    $range = $ranges[$setResult['range_id']];
                    // On initialise simplement le nombre de sets présents dans cette gamme
                    $range['sets_count'] = 0;
                }
                // On mémorise l'id de la gamme
                $previousRange = $setResult['range_id'];
            }
            // Si cette gamme contient une nouvelle série
            if ($setResult['serie_id'] != $previousSerie) {
                // Et que cette série ne figure pas déjà dans la liste
                if (!array_key_exists($setResult['serie_id'], $range['series'])) {
                    // On récupère les infos de la série
                    $serie = [];
                    $serie['id'] = $setResult['serie_id'];
                    $serie['name'] = $setResult['serie_name'];
                    // On initialise le nombre de sets présents dans cette série
                    $serie['sets_count'] = 0;
                    // On ajoute la série à la liste
                    $range['series'][$serie['id']] = $serie;
                }
                // La série figure déjà dans la liste
                else {
                    $serie = $range['series'][$setResult['serie_id']];
                    // On initialise simplement le nombre de sets présents dans cette série
                    $serie['sets_count'] = 0;
                }
                // On crée le tableau qui va contenir la liste des sets
                $serie['sets'] = [];
                // Et on mémorise l'id de la série
                $previousSerie = $setResult['serie_id'];
            }
            // On récupère les infos du set
            $set = [];
            $set['id'] = $setResult['id'];
            $set['number'] = $setResult['number'];
            $set['name'] = $setResult['name'];
            $set['slug'] = $setResult['slug'];
            $set['picture'] = $setResult['picture'];
            $set['release_year'] = $setResult['release_year'];
            $set['price'] = $setResult['price'];
            $set['count'] = $setResult['item_count'];
            $set['sell_total'] = $setResult['sell_total'];
            $set['exchange_total'] = $setResult['exchange_total'];
            // On l'ajoute à la liste
            $range['series'][$serie['id']]['sets'][$set['id']] = $set;
            // Et on met à jour les nombres de sets
            $range['sets_count'] += $set['count'];
            $range['series'][$serie['id']]['sets_count'] += $set['count'];
            $setsCount += $set['count'];
        }

        // Lorsqu'on a fini de parcourir les sets, si une gamme existe
        if (isset($range)) {
            // On n'oublie pas de la rajouter à la liste des gammes
            $ranges[$range['id']] = $range;
        }

        // On prépare les données pour l'affichage du graphique
        $totalCount = $minifiguresCount + $setsCount;
        foreach ($ranges as $range) {
            $itemCount = 0;
            if (isset($range['minifigures_count']))
                $itemCount += $range['minifigures_count'];
            if (isset($range['sets_count']))
                $itemCount += $range['sets_count'];
            $ranges[$range['id']]['percentage'] = round(($itemCount*100) / $totalCount, 5);
        }

        // On retourne la collection
        $collection = [];
        $collection['ranges'] = $ranges;
        $collection['minifigures_count'] = $minifiguresCount;
        $collection['sets_count'] = $setsCount;
        return $collection;
    }

    /**
     * Récupère toutes les figurines d'une collection
     * @param int $userId Id de l'utilisateur auquel appartient la collection
     * @return array
     */
    private function findAllMinifiguresFromCollection($userId)
    {
        return $this->getEntityManager()->createQuery('
            SELECT mf.id, 
                mf.name, 
                mf.slug, 
                mf.picture, 
                mf.release_year, 
                sr.id AS serie_id, 
                sr.name AS serie_name, 
                rg.id AS range_id, 
                rg.name AS range_name, 
                rg.color AS range_color, 
                cl_it.item_count, 
            SUM(CASE WHEN ofr.type LIKE \'%Vente%\' THEN 1 ELSE 0 END) AS sell_total, 
            SUM(CASE WHEN ofr.type LIKE \'%Echange%\' THEN 1 ELSE 0 END) AS exchange_total, 
            MIN(ofr.price) AS price
            FROM AppBundle:Minifigure mf
            INNER JOIN mf.collection_items cl_it
            INNER JOIN mf.serie sr
            INNER JOIN sr.range rg
            LEFT JOIN mf.offer_items ofr_it
            LEFT JOIN ofr_it.offer ofr
            WHERE cl_it.user = :user_id
            GROUP BY mf.id
            ORDER BY rg.priority, rg.name, sr.priority, sr.name, mf.id
        ')
        ->setParameter('user_id', $userId)
        ->getArrayResult();
    }

    /**
     * Récupère tous les sets d'une collection
     * @param int $userId Id de l'utilisateur auquel appartient la collection
     * @return array
     */
    private function findAllSetsFromCollection($userId)
    {
        return $this->getEntityManager()->createQuery('
            SELECT st.id, 
                st.number, 
                st.name, 
                st.slug, 
                st.picture, 
                st.release_year, 
                st.price, 
                sr.id AS serie_id, 
                sr.name AS serie_name, 
                rg.id AS range_id, 
                rg.name AS range_name, 
                rg.color AS range_color, 
                cl_it.item_count, 
            SUM(CASE WHEN ofr.type LIKE \'%Vente%\' THEN 1 ELSE 0 END) AS sell_total, 
            SUM(CASE WHEN ofr.type LIKE \'%Echange%\' THEN 1 ELSE 0 END) AS exchange_total, 
            MIN(ofr.price) AS price
            FROM AppBundle:Set st
            INNER JOIN st.collection_items cl_it
            INNER JOIN st.serie sr
            INNER JOIN sr.range rg
            LEFT JOIN st.offer_items ofr_it
            LEFT JOIN ofr_it.offer ofr
            WHERE cl_it.user = :user_id
            GROUP BY st.id
            ORDER BY rg.priority, rg.name, sr.priority, sr.name, st.id
        ')
        ->setParameter('user_id', $userId)
        ->getArrayResult();
    }

}
