<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Range;

class LoadRangeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ranges = [
            1 => [
                'name' => 'Star Wars',
                'slug' => 'star-wars',
                'color' => '#e31f1f',
                'picture' => '1-star-wars.png',
                'priority' => '0',
            ],
            2 => [
                'name' => 'Minifigures',
                'slug' => 'minifigures',
                'color' => '#27910e',
                'picture' => '2-minifigures.png',
                'priority' => '0',
            ],
        ];

        $i = 1;
        foreach ($ranges as $range_data) {
            $range = new Range();
            $range->setName($range_data['name']);
            $range->setSlug($range_data['slug']);
            $range->setColor($range_data['color']);
            $range->setPicture($range_data['picture']);
            $range->setPriority($range_data['priority']);

            $manager->persist($range);

            $this->setReference('range_' . $i, $range);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}