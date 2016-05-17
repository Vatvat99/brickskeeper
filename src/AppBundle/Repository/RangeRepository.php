<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * RangeRepository
 */
class RangeRepository extends EntityRepository
{
    public function getRangesWithSeries()
    {
       /* $query = $this->getEntityManager()
            ->createQuery(
                'SELECT rg FROM AppBundle:Range rg JOIN (SELECT sr FROM AppBundle:Serie sr
WHERE EXISTS (SELECT mf FROM AppBundle:Minifigure mf WHERE mf.serie_id = sr.id)
OR EXISTS (SELECT st FROM AppBundle:Set st WHERE st.serie_id = sr.id)) AppBundle:Serie sr2
ON sr2.range_id = rg.id'
            ); */

       /* Fonctionne ---
       SELECT *
        FROM brickskeeper_range rg
INNER JOIN
    (SELECT * FROM brickskeeper_serie sr
WHERE EXISTS (SELECT * FROM brickskeeper_minifigure mf WHERE mf.serie_id = sr.id)
OR EXISTS (SELECT * FROM brickskeeper_set st WHERE st.serie_id = sr.id)) sr2
ON sr2.range_id = rg.id; */

       /* SELECT *
        FROM brickskeeper_range rg
LEFT JOIN brickskeeper_serie sr ON rg.id = sr.range_id
LEFT JOIN brickskeeper_minifigure mf ON sr.id = mf.serie_id
LEFT JOIN brickskeeper_set st ON sr.id = st.serie_id
WHERE (SELECT COUNT(*) FROM brickskeeper_minifigure) */


        /* @todo : ajouter une clause pour ne pas sélectionner les gammes et série qui ne contiennent aucune figurine / set
         */
        $query = $this->createQueryBuilder('rg')
            ->addSelect('sr')
            ->leftJoin('rg.series', 'sr')
            ->leftJoin('sr.minifigures', 'mf')
            ->leftJoin('sr.sets', 'st')
            ->getQuery();

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }

        // Récupérer le nombre de figurine et de sets par gamme


        // et par série
        /* $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select($qb->expr()->count('mf.id'))
            ->from('AppBundle:Range', 'rg')
            ->leftJoin('rg.series', 'sr')
            ->leftJoin('sr.minifigures', 'mf')
            ->leftJoin('sr.sets', 'st')
            ->groupBy('rg, sr');

            $query = $qb->getQuery()->getResult();


        return $query;

        $query = $this->createQueryBuilder('rg')
            ->expr()->count('mf.id')
            ->addSelect('sr')
            ->addSelect('count(mf.id) AS minifigures_count')
            ->addSelect('count(st.id) AS sets_count')
            ->leftJoin('rg.series', 'sr')
            ->leftJoin('sr.minifigures', 'mf')
            ->leftJoin('sr.sets', 'st')
            ->groupBy('rg, sr')
            ->getQuery()->getResult();

        return $query; */



        /* foreach ($ranges->getSeries() as $range) {
            $query_builder = $this->createQueryBuilder('r')
                ->leftJoin('r.series', 's')
                ->addSelect('s');
        } */

    }

    public function getMinifiguresInRange($id)
    {
        $query = $this->createQueryBuilder('rg')
            ->select('count(mf.id)')
            ->leftJoin('rg.series', 'sr')
            ->leftJoin('sr.minifigures', 'mf')
            ->where('rg.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getSetsInRange($id)
    {
        $query = $this->createQueryBuilder('rg')
            ->select('count(st.id)')
            ->leftJoin('rg.series', 'sr')
            ->leftJoin('sr.sets', 'st')
            ->where('rg.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function findOneBySerieSlug($slug)
    {
        $query = $this->createQueryBuilder('rg')
            ->leftJoin('rg.series', 'sr')
            ->where('sr.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery();

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function findAllRanges()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT rg.id AS id, 
                    rg.name AS name, 
                    rg.slug AS slug 
                FROM AppBundle:Range rg 
                ORDER BY rg.priority, rg.name
            ')
            ->getArrayResult();
    }

    public function findRangeBySlug($slug)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT rg.id AS id, 
                rg.name AS name, 
                rg.slug AS slug
                FROM AppBundle:Range rg
                WHERE rg.slug = :slug
                ORDER BY rg.priority, rg.name
            ')
            ->setParameter('slug', $slug)
            ->getArrayResult();
    }

    /**
     * Récupère une gamme à partir du slug d'une série
     * @param $slug Slug de la série
     */
    public function findRangeBySerieSlug($slug)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT rg.id AS id, 
                    rg.name AS name, 
                    rg.slug AS slug
                FROM AppBundle:Range rg
                JOIN rg.series sr
                WHERE sr.slug = :slug
                ORDER BY rg.priority, rg.name
            ')
            ->setParameter('slug', $slug)
            ->getArrayResult();
    }

}
