<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * SerieRepository
 */
class SerieRepository extends EntityRepository
{

    /**
     * Récupère le nombre de minifigures dans une série
     * @param $id
     * @return mixed|null
     */
    public function getMinifiguresInSerie($id)
    {
        $query = $this->createQueryBuilder('sr')
            ->select('count(mf.id)')
            ->leftJoin('sr.minifigures', 'mf')
            ->where('sr.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * Récupère le nombre de sets dans une série
     * @param $id
     * @return mixed|null
     */
    public function getSetsInSerie($id)
    {
        $query = $this->createQueryBuilder('sr')
            ->select('count(st.id)')
            ->leftJoin('sr.sets', 'st')
            ->where('sr.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function findSeriesByRange($rangeId)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT sr.id AS id, 
                    sr.name AS name, 
                    sr.slug AS slug
                FROM AppBundle:Serie sr
                JOIN sr.range rg
                WHERE rg.id = :id
                ORDER BY sr.priority, sr.name
            ')
            ->setParameter('id', $rangeId)
            ->getArrayResult();
    }

    public function findSerieBySlug($slug)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT sr.id AS id,
                    sr.name AS name, 
                    sr.slug AS slug
                FROM AppBundle:Serie sr
                WHERE sr.slug = :slug
            ')
            ->setParameter('slug', $slug)
            ->getArrayResult();
    }
    
}
