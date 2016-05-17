<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CollectionItem;

class LoadCollectionItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $collections_items = [
            1 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_19'),
                'set' => null,
                'item_count' => 1,
            ],
            2 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_20'),
                'set' => null,
                'item_count' => 1,
            ],
            3 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_21'),
                'set' => null,
                'item_count' => 1,
            ],
            4 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_22'),
                'set' => null,
                'item_count' => 1,
            ],
            5 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_23'),
                'set' => null,
                'item_count' => 1,
            ],
            6 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_24'),
                'set' => null,
                'item_count' => 1,
            ],
            7 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_25'),
                'set' => null,
                'item_count' => 1,
            ],
            8 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_26'),
                'set' => null,
                'item_count' => 1,
            ],
            9 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_27'),
                'set' => null,
                'item_count' => 1,
            ],
            10 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_28'),
                'set' => null,
                'item_count' => 1,
            ],
            11 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_29'),
                'set' => null,
                'item_count' => 1,
            ],
            12 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_30'),
                'set' => null,
                'item_count' => 1,
            ],
            13 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_31'),
                'set' => null,
                'item_count' => 1,
            ],
            14 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_32'),
                'set' => null,
                'item_count' => 1,
            ],
            15 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_33'),
                'set' => null,
                'item_count' => 1,
            ],
            16 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => $this->getReference('minifigure_34'),
                'set' => null,
                'item_count' => 1,
            ],
            17 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => null,
                'set' => $this->getReference('set_1'),
                'item_count' => 1,
            ],
            18 => [
                'user' => $this->getReference('user_1'),
                'minifigure' => null,
                'set' => $this->getReference('set_2'),
                'item_count' => 1,
            ],
            19 => [
                'user' => $this->getReference('user_3'),
                'minifigure' => $this->getReference('minifigure_32'),
                'set' => null,
                'item_count' => 1,
            ],
            20 => [
                'user' => $this->getReference('user_3'),
                'minifigure' => $this->getReference('minifigure_33'),
                'set' => null,
                'item_count' => 1,
            ],
            21 => [
                'user' => $this->getReference('user_3'),
                'minifigure' => null,
                'set' => $this->getReference('set_2'),
                'item_count' => 1,
            ],
        ];

        $i = 1;
        foreach ($collections_items as $collection_item_data) {
            $collection_item = new CollectionItem();
            $collection_item->setUser($collection_item_data['user']);
            $collection_item->setMinifigure($collection_item_data['minifigure']);
            $collection_item->setSet($collection_item_data['set']);
            $collection_item->setItemCount($collection_item_data['item_count']);

            $manager->persist($collection_item);

            $this->setReference('collection_item_' . $i, $collection_item);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}