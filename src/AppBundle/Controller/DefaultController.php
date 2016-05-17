<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\SearchType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // On récupère la liste des gammes
        $ranges = $this->getDoctrine()
            ->getRepository('AppBundle:Range')
            ->getRangesWithSeries();

        foreach ($ranges as $range) {
            // On compte le nombre de figurine dans la gamme
            $range->minifigures_count = $this->getDoctrine()
                ->getRepository('AppBundle:Range')
                ->getMinifiguresInRange($range->getId());
            // On compte le nombre de sets dans la gamme
            $range->sets_count = $this->getDoctrine()
                ->getRepository('AppBundle:Range')
                ->getSetsInRange($range->getId());

            if ($series = $range->getSeries()) {
                foreach ($series as $serie) {
                    // On compte le nombre de figurine dans la série
                    $serie->minifigures_count = $this->getDoctrine()
                        ->getRepository('AppBundle:Serie')
                        ->getMinifiguresInSerie($serie->getId());
                    // On compte le nombre de sets dans la série
                    $serie->sets_count = $this->getDoctrine()
                        ->getRepository('AppBundle:Serie')
                        ->getSetsInSerie($serie->getId());
                }
            }
        }

        // On prépare le formulaire de recherche
        $form = $this->createForm(SearchType::class, null, [
            'action' => $this->generateUrl('search')
        ]);

        
        return $this->render('front/index.html.twig', [
            'ranges' => $ranges,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

}
