<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Minifigure;

class LoadMinifigureData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $minifigures = [
            1 => [
                'name' => 'Anakin Skywalker',
                'slug' => 'anakin-skywalker',
                'picture' => '1-anakin-skywalker.jpg',
                'release_year' => new \DateTime(''),
                'serie' => $this->getReference('serie_1'),
            ],
            2 => [
                'name' => 'R2-D2',
                'slug' => 'r2-d2',
                'picture' => '2-r2-d2.jpg',
                'release_year' => new \DateTime(''),
                'serie' => $this->getReference('serie_1'),
            ],
            3 => [
                'name' => 'Pilote clone',
                'slug' => 'pilote-clone',
                'picture' => '3-pilote-clone.jpg',
                'release_year' => new \DateTime(''),
                'serie' => $this->getReference('serie_2'),
            ],
            4 => [
                'name' => 'Pong Krell',
                'slug' => 'pong-krell',
                'picture' => '4-pong-krell.jpg',
                'release_year' => new \DateTime(''),
                'serie' => $this->getReference('serie_2'),
            ],
            5 => [
                'name' => 'Soldat clone',
                'slug' => 'soldat-clone',
                'picture' => '5-soldat-clone.jpg',
                'release_year' => new \DateTime(''),
                'serie' => $this->getReference('serie_2'),
            ],
            6 => [
                'name' => 'Officier impérial',
                'slug' => 'officier-imperial',
                'picture' => '6-officier-imperial.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            7 => [
                'name' => 'Pilote TIE',
                'slug' => 'pilote-tie',
                'picture' => '7-pilote-tie.jpg',
                'release_year' => new \DateTime('2010'),
                'serie' => $this->getReference('serie_1'),
            ],
            8 => [
                'name' => 'R5-J2',
                'slug' => 'r5-j2',
                'picture' => '8-r5-j2.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            9 => [
                'name' => 'Soldat de la flotte impériale',
                'slug' => 'soldat-de-la-flotte-imperiale',
                'picture' => '9-soldat-de-la-flotte-imperiale.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            10 => [
                'name' => 'Jek Porkins',
                'slug' => 'jek-porkins',
                'picture' => '10-jek-porkins.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            11 => [
                'name' => 'Luke Skywalker',
                'slug' => 'luke-skywalker',
                'picture' => '11-luke-skywalker.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            12 => [
                'name' => 'R2-D2',
                'slug' => 'r2-d2',
                'picture' => '12-r2-d2.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            13 => [
                'name' => 'R5-D8',
                'slug' => 'r5-d8',
                'picture' => '13-r5-d8.jpg',
                'release_year' => new \DateTime('2012'),
                'serie' => $this->getReference('serie_1'),
            ],
            14 => [
                'name' => 'Coleman Trebor',
                'slug' => 'coleman-trebor',
                'picture' => '14-coleman-trebor.jpg',
                'release_year' => new \DateTime('2013'),
                'serie' => $this->getReference('serie_1'),
            ],
            15 => [
                'name' => 'Mace Windu',
                'slug' => 'mace-windu',
                'picture' => '15-mace-windu.jpg',
                'release_year' => new \DateTime('2013'),
                'serie' => $this->getReference('serie_1'),
            ],
            16 => [
                'name' => 'Commandant clone',
                'slug' => 'commandant-clone',
                'picture' => '16-commandant-clone.jpg',
                'release_year' => new \DateTime('2013'),
                'serie' => $this->getReference('serie_1'),
            ],
            17 => [
                'name' => 'Commandant droïde de combat',
                'slug' => 'commandant-droide-de-combat',
                'picture' => '17-commandant-droide-de-combat.jpg',
                'release_year' => new \DateTime('2013'),
                'serie' => $this->getReference('serie_1'),
            ],
            18 => [
                'name' => 'Droïde de combat',
                'slug' => 'droide-de-combat',
                'picture' => '18-droide-de-combat.jpg',
                'release_year' => new \DateTime('2013'),
                'serie' => $this->getReference('serie_1'),
            ],
            19 => [
                'name' => 'Agent de contrôle des animaux',
                'slug' => 'agent-de-controle-des-animaux',
                'picture' => '19-agent-de-controle-des-animaux.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            20 => [
                'name' => 'Astronaute',
                'slug' => 'astronaute',
                'picture' => '20-astronaute.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            21 => [
                'name' => 'Ballerine',
                'slug' => 'ballerine',
                'picture' => '21-ballerine.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            22 => [
                'name' => 'Homme maladroit',
                'slug' => 'homme-maladroit',
                'picture' => '22-homme-maladroit.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            23 => [
                'name' => 'Fermier',
                'slug' => 'fermier',
                'picture' => '23-fermier.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            24 => [
                'name' => 'Faune',
                'slug' => 'faune',
                'picture' => '24-faune.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            25 => [
                'name' => 'Guerrier volant',
                'slug' => 'guerrier-volant',
                'picture' => '25-guerrier-volant.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            26 => [
                'name' => 'Chevalier de l\'effroi',
                'slug' => 'chevalier-de-l-effroi',
                'picture' => '26-chevalier-de-l-effroi.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            27 => [
                'name' => 'Nettoyeur',
                'slug' => 'nettoyeur',
                'picture' => '27-nettoyeur.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            28 => [
                'name' => 'Voleuse de pierres précieuses',
                'slug' => 'voleuse-de-pierres-precieuses',
                'picture' => '28-voleuse-de-pierres-precieuses.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            29 => [
                'name' => 'Kendoka',
                'slug' => 'kendoka',
                'picture' => '29-kendoka.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            30 => [
                'name' => 'Robot laser',
                'slug' => 'robot-laser',
                'picture' => '30-robot-laser.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            31 => [
                'name' => 'Reine',
                'slug' => 'reine',
                'picture' => '31-reine.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            32 => [
                'name' => 'Homme requin',
                'slug' => 'homme-requin',
                'picture' => '32-homme-requin.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            33 => [
                'name' => 'Femme tribale',
                'slug' => 'femme-tribale',
                'picture' => '33-femme-tribale.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            34 => [
                'name' => 'Champion de lutte',
                'slug' => 'champion-de-lutte',
                'picture' => '34-champion-de-lutte.jpg',
                'release_year' => new \DateTime('2016'),
                'serie' => $this->getReference('serie_3'),
            ],
            35 => [
                'name' => 'Le monstre mouche',
                'slug' => 'le-monstre-mouche',
                'picture' => '35-le-monstre-mouche.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            36 => [
                'name' => 'Banshee',
                'slug' => 'banshee',
                'picture' => '36-banshee.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            37 => [
                'name' => 'Monstre scientifique',
                'slug' => 'monstre-scientifique',
                'picture' => '37-monstre-scientifique.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            38 => [
                'name' => 'Sorcière loufoque',
                'slug' => 'sorciere-loufoque',
                'picture' => '38-sorciere-loufoque.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            39 => [
                'name' => 'Gargouille',
                'slug' => 'gargouille',
                'picture' => '39-gargouille.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            40 => [
                'name' => 'Rocker monstre',
                'slug' => 'rocker-monstre',
                'picture' => '40-rocker-monstre.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            41 => [
                'name' => 'Femme araignée',
                'slug' => 'femme-araignee',
                'picture' => '41-femme-araignee.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            42 => [
                'name' => 'Spectre',
                'slug' => 'spectre',
                'picture' => '42-spectre.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            43 => [
                'name' => 'Homme squelette',
                'slug' => 'homme-squelette',
                'picture' => '43-homme-squelette.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            44 => [
                'name' => 'Pied carré',
                'slug' => 'pied-carre',
                'picture' => '44-pied-carre.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            45 => [
                'name' => 'Femme tigre',
                'slug' => 'femme-tigre',
                'picture' => '45-femme-tigre.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            46 => [
                'name' => 'Homme loup',
                'slug' => 'homme-loup',
                'picture' => '46-homme-loup.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            47 => [
                'name' => 'Pirate zombie',
                'slug' => 'pirate-zombie',
                'picture' => '47-pirate-zombie.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            48 => [
                'name' => 'Pom-pom girl zombie',
                'slug' => 'pom-pom-girl-zombie',
                'picture' => '48-pom-pom-girl-zombie.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            49 => [
                'name' => 'Homme d\'affaires zombie',
                'slug' => 'homme-d-affaires-zombie',
                'picture' => '49-homme-d-affaires-zombie.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],
            50 => [
                'name' => 'Monstre plante',
                'slug' => 'monstre-plante',
                'picture' => '50-monstre-plante.jpg',
                'release_year' => new \DateTime('2015'),
                'serie' => $this->getReference('serie_4'),
            ],

        ];

        $i = 1;
        foreach ($minifigures as $minifigure_data) {
            $minifigure = new Minifigure();
            $minifigure->setName($minifigure_data['name']);
            $minifigure->setSlug($minifigure_data['slug']);
            $minifigure->setPicture($minifigure_data['picture']);
            $minifigure->setReleaseYear($minifigure_data['release_year']);
            $minifigure->setSerie($minifigure_data['serie']);

            $manager->persist($minifigure);

            $this->setReference('minifigure_' . $i, $minifigure);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}