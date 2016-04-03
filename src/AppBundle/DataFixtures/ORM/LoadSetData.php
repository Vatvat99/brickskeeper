<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Set;

class LoadSetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sets = [
            1 => [
                'number' => '9493',
                'name' => 'X-Wing Starfighter',
                'slug' => 'x-wing-starfighter',
                'picture' => '1-x-wing-starfighter.jpg',
                'release_year' => '2012',
                'price' => '74.99',
                'serie' => $this->getReference('serie_1'),
            ],
            2 => [
                'number' => '9492',
                'name' => 'Tie Fighter',
                'slug' => 'tie-fighter',
                'picture' => '2-tie-fighter.jpg',
                'release_year' => '2012',
                'price' => '59.99',
                'serie' => $this->getReference('serie_1'),
            ],
            3 => [
                'number' => '75019',
                'name' => 'AT-TE',
                'slug' => 'at-te',
                'picture' => '3-at-te.jpg',
                'release_year' => '2013',
                'price' => '99.99',
                'serie' => $this->getReference('serie_1'),
            ],
            4 => [
                'number' => '75004',
                'name' => 'Z-95 Headhunter',
                'slug' => 'z-95-headhunter',
                'picture' => '4-z-95-headhunter.jpg',
                'release_year' => '2013',
                'price' => '56.99',
                'serie' => $this->getReference('serie_2'),
            ],
            5 => [
                'number' => '75038',
                'name' => 'Jedi Interceptor',
                'slug' => 'jedi-interceptor',
                'picture' => '5-jedi-interceptor.jpg',
                'release_year' => '2014',
                'price' => '29.99',
                'serie' => $this->getReference('serie_1'),
            ],
        ];

        $i = 1;
        foreach ($sets as $set_data) {
            $set = new Set();
            $set->setNumber($set_data['number']);
            $set->setName($set_data['name']);
            $set->setSlug($set_data['slug']);
            $set->setPicture($set_data['picture']);
            $set->setReleaseYear($set_data['release_year']);
            $set->setPrice($set_data['price']);
            $set->setSerie($set_data['serie']);

            $manager->persist($set);

            $this->setReference('set_' . $i, $set);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}