<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\MinifigureSet;

class LoadMinifigureSetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $minifigures_sets = [
            1 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_1'),
                'set' => $this->getReference('set_5'),

            ],
            2 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_2'),
                'set' => $this->getReference('set_5'),
            ],
            3 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_3'),
                'set' => $this->getReference('set_4'),
            ],
            4 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_4'),
                'set' => $this->getReference('set_4'),
            ],
            5 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_5'),
                'set' => $this->getReference('set_4'),
            ],
            6 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_6'),
                'set' => $this->getReference('set_2'),
            ],
            7 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_7'),
                'set' => $this->getReference('set_2'),
            ],
            8 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_8'),
                'set' => $this->getReference('set_2'),
            ],
            9 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_9'),
                'set' => $this->getReference('set_2'),
            ],
            10 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_10'),
                'set' => $this->getReference('set_1'),
            ],
            11 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_11'),
                'set' => $this->getReference('set_1'),
            ],
            12 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_12'),
                'set' => $this->getReference('set_1'),
            ],
            13 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_13'),
                'set' => $this->getReference('set_1'),
            ],
            14 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_14'),
                'set' => $this->getReference('set_3'),
            ],
            15 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_15'),
                'set' => $this->getReference('set_3'),
            ],
            16 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_16'),
                'set' => $this->getReference('set_3'),
            ],
            17 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_17'),
                'set' => $this->getReference('set_3'),
            ],
            18 => [
                'item_count' => '1',
                'minifigure' => $this->getReference('minifigure_18'),
                'set' => $this->getReference('set_3'),
            ],
        ];

        foreach ($minifigures_sets as $minifigure_set_data) {
            $minifigure_set = new MinifigureSet();
            $minifigure_set->setItemCount($minifigure_set_data['item_count']);
            $minifigure_set->setMinifigure($minifigure_set_data['minifigure']);
            $minifigure_set->setSet($minifigure_set_data['set']);

            $manager->persist($minifigure_set);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}