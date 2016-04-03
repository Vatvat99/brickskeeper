<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Serie;

class LoadSerieData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $series = [
            1 => [
                'name' => 'Episodes I-VI',
                'slug' => 'episodes-i-vi',
                'picture' => '1-episodes-i-vi.png',
                'priority' => '0',
                'range' => $this->getReference('range_1'),
            ],
            2 => [
                'name' => 'Clone Wars',
                'slug' => 'clone-wars',
                'picture' => '2-clone-wars.png',
                'priority' => '0',
                'range' => $this->getReference('range_1'),
            ],
            3 => [
                'name' => 'Série 15',
                'slug' => 'serie-15',
                'picture' => '3-serie-15.jpg',
                'priority' => '0',
                'range' => $this->getReference('range_2'),
            ],
            4 => [
                'name' => 'Série 14',
                'slug' => 'serie-14',
                'picture' => '4-serie-14.png',
                'priority' => '0',
                'range' => $this->getReference('range_2'),
            ],
        ];

        $i = 1;
        foreach ($series as $serie_data) {
            $serie = new Serie();
            $serie->setName($serie_data['name']);
            $serie->setSlug($serie_data['slug']);
            $serie->setPicture($serie_data['picture']);
            $serie->setPriority($serie_data['priority']);
            $serie->setRange($serie_data['range']);

            $manager->persist($serie);

            $this->setReference('serie_' . $i, $serie);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}