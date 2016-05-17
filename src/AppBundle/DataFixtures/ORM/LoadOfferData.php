<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Offer;

class LoadOfferData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offers = [
            1 => [
                'title' => 'Voleuse de pierres précieuses',
                'description' => 'Annonce de test avec seulement une figurine avec photos.',
                'type' => ['Echange'],
                'price' => '0.00',
                'active' => '1',
                'submitted_at' => new \Datetime('2016-04-03 12:30:12'),
                'user' => $this->getReference('user_1'),
            ],
            2 => [
                'title' => 'Minifigures diverses - état neuf',
                'description' => 'Vend sachet minifig lego séries 14 neuf non ouvert.

n°1 le monstre scientifique 3 euros.
n°2 la sorcière loufoque à 3€.
n°3 la gargouille à 3€.

Envoi possible en plus en lettre éco ou autre mode d\'envoi sur demande.',
                'type' => ['Echange', 'Vente'],
                'price' => '9.00',
                'active' => '1',
                'submitted_at' => new \Datetime('2016-04-03 19:27:00'),
                'user' => $this->getReference('user_1'),
            ],
            3 => [
                'title' => 'Mes figurines',
                'description' => 'Je vends cette figurine que je n\'aime plus, voilà.',
                'type' => ['Vente'],
                'price' => '8.50',
                'active' => '1',
                'submitted_at' => new \Datetime('2016-05-07 12:03:00'),
                'user' => $this->getReference('user_2'),
            ],
        ];

        $i = 1;
        foreach ($offers as $offer_data) {
            $offer = new Offer();
            $offer->setTitle($offer_data['title']);
            $offer->setDescription($offer_data['description']);
            $offer->setType($offer_data['type']);
            $offer->setPrice($offer_data['price']);
            $offer->setActive($offer_data['active']);
            $offer->setSubmittedAt($offer_data['submitted_at']);
            $offer->setUser($offer_data['user']);

            $manager->persist($offer);

            $this->setReference('offer_' . $i, $offer);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}