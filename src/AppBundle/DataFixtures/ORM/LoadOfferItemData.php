<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\OfferItem;

class LoadOfferItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offers_items = [
            1 => [
                'offer' => $this->getReference('offer_1'),
                'minifigure' => $this->getReference('minifigure_28'),
                'set' => null,
                'item_count' => 1,
            ],
            2 => [
                'offer' => $this->getReference('offer_2'),
                'minifigure' => $this->getReference('minifigure_37'),
                'set' => null,
                'item_count' => 1,
            ],
            3 => [
                'offer' => $this->getReference('offer_2'),
                'minifigure' => $this->getReference('minifigure_38'),
                'set' => null,
                'item_count' => 1,
            ],
            4 => [
                'offer' => $this->getReference('offer_2'),
                'minifigure' => null,
                'set' => $this->getReference('set_1'),
                'item_count' => 1,
            ],
            5 => [
                'offer' => $this->getReference('offer_3'),
                'minifigure' => $this->getReference('minifigure_32'),
                'set' => null,
                'item_count' => 1,
            ],
        ];

        $i = 1;
        foreach ($offers_items as $offer_item_data) {
            $offer_item = new OfferItem();
            $offer_item->setOffer($offer_item_data['offer']);
            $offer_item->setMinifigure($offer_item_data['minifigure']);
            $offer_item->setSet($offer_item_data['set']);
            $offer_item->setItemCount($offer_item_data['item_count']);

            $manager->persist($offer_item);

            $this->setReference('offer_item_' . $i, $offer_item);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}