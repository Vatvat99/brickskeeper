<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\SearchType;

class SearchController extends Controller
{

    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        // On prépare le formulaire de recherche
        $form = $this->createForm(SearchType::class, null, [
            'action' => $this->generateUrl('search')
        ]);

        $form->handleRequest($request);

        $selectedRangeAlias = '';
        $selectedSerieAlias = '';
        $results = '';
        $collection = '';

        // Si le formulaire a été posté
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            if ($data['selected_range_alias'] != 'none')
                $selectedRangeAlias = $data['selected_range_alias'];

            if ($data['selected_serie_alias'] != 'none')
                $selectedSerieAlias = $data['selected_serie_alias'];

            // On fait la recherche
            $results = $this->getResults($data['item_type'], $selectedRangeAlias, $selectedSerieAlias);

            // Si l'utilisateur est connecté
            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                // On récupère également la collection de l'utilisateur
                $collection = $this->getDoctrine()
                    ->getRepository('AppBundle:CollectionItem')
                    ->findCollection($this->getUser()->getId());
            }
            
        }

        return $this->render('front/search.html.twig', [
            'selectedRangeAlias' => $selectedRangeAlias,
            'selectedSerieAlias' => $selectedSerieAlias,
            'results' => $results,
            'itemType' => (isset($data['item_type'])) ? $data['item_type'] : '',
            'collection' => $collection,
        ]);

    }

    /**
     * Retourne les résultats d'une recherche
     * @param $itemType Type d'élément recherché (minifigures / sets)
     * @param $rangeAlias Alias de la gamme recherché
     * @param $serieAlias Alias de la série recherchée
     * @return array
     */
    private function getResults($itemType, $rangeAlias, $serieAlias)
    {
        $entityManager = $this->getDoctrine();
        $rangeRepository = $entityManager->getRepository('AppBundle:Range');
        $serieRepository = $entityManager->getRepository('AppBundle:Serie');
        $results = [];

        // Si aucune gamme et série n'est renseignée
        if ($rangeAlias == '' && $serieAlias == '') {
            // On récupère toutes les gammes
            $results['ranges'] = $rangeRepository->findAllRanges();
        }
        // Si une gamme est renseignée mais pas de série
        elseif ($rangeAlias != '' && $serieAlias == '') {
            // On récupère la gamme correspondante
            $results['ranges'] = $rangeRepository->findRangeBySlug($rangeAlias);
        } elseif ($serieAlias != '') {
            // On récupère la gamme correspondant à la série
            $results['ranges'] = $rangeRepository->findRangeBySerieSlug($serieAlias);
        }

        // Pour chaque gamme, on récupère les séries
        $minifiguresCount = 0;
        $setsCount = 0;
        $i = 0;
        foreach ($results['ranges'] as $range) {

            $minifiguresInRangeCount = 0;
            $setsInRangeCount = 0;

            // Si pas d'alias série, on récupère toutes les séries
            if ($serieAlias == '') {
                $results['ranges'][$i]['series'] = $serieRepository->findSeriesByRange($range['id']);
            }
            // Si un alias série, on récupère seulement cette série
            else {
                $results['ranges'][$i]['series'] = $serieRepository->findSerieBySlug($serieAlias);
            }

            // Pour chaque série, on récupère tous les éléments
            $j = 0;
            foreach ($results['ranges'][$i]['series'] as $serie) {
                // Si on recherche des figurines
                if ($itemType == 'minifigure') {
                    $minifigureRepository = $entityManager->getRepository('AppBundle:Minifigure');
                    $results['ranges'][$i]['series'][$j]['minifigures'] = $minifigureRepository->findMinifiguresFromSerie($serie['id']);

                    $minifiguresInRangeCount += count($results['ranges'][$i]['series'][$j]['minifigures']);
                    $minifiguresCount += count($results['ranges'][$i]['series'][$j]['minifigures']);
                    $results['ranges'][$i]['series'][$j]['minifigures_count'] = count($results['ranges'][$i]['series'][$j]['minifigures']);
                }
                // Si on recherche des sets
                else {
                    $setRepository = $entityManager->getRepository('AppBundle:Set');
                    $results['ranges'][$i]['series'][$j]['sets'] = $setRepository->findSetsFromSerie($serie['id']);

                    $setsInRangeCount += count($results['ranges'][$i]['series'][$j]['sets']);
                    $setsCount += count($results['ranges'][$i]['series'][$j]['sets']);
                    $results['ranges'][$i]['series'][$j]['sets_count'] = count($results['ranges'][$i]['series'][$j]['sets']);
                }
                $j++;
            }

            // Si on recherche des figurines
            if ($itemType == 'minifigure')
                $results['ranges'][$i]['minifigures_count'] = $minifiguresInRangeCount;
            // Si on recherche des sets
            else
                $results['ranges'][$i]['sets_count'] = $setsInRangeCount;
            $i++;
        }

        // Si on recherche des figurines
        if ($itemType == 'minifigure')
            $results['minifigures_count'] = $minifiguresCount;
        // Si on recherche des sets
        else
            $results['sets_count'] = $setsCount;

        return $results;
    }

}