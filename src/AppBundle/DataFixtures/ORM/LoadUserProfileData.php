<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\UserProfile;

class LoadUserProfileData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users_profiles = [
            1 => [
                'city' => 'Dijon',
                'region' => 'Bourgogne-Franche-Comté',
                'message' => 'Hey, j’ai découvert ce site trop cool et depuis je ne m’en passe plus. Je peux gérer toute ma collection lego et l’agrandir super facilement en faisant des échanges avec les autres membres.',
                'picture' => '572dae439f813.png',
                'updated_at' => new \DateTime('2016-05-07 10:58:43'),
                'user' => $this->getReference('user_1'),
            ],
            2 => [
                'city' => '',
                'region' => '',
                'message' => '',
                'picture' => '572dbba9b197e.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:02:38'),
                'user' => $this->getReference('user_2'),
            ],
            3 => [
                'city' => 'Lyon',
                'region' => 'Rhône-Alpes',
                'message' => 'Bonjour tout le monde, moi c’est Julie, je suis fan de legos depuis que je suis toute petite. Je collectionne surtout les minifigures et en recherche donc pas mal. N’hésitez pas à consulter mes annonces et à me contacter si vous voulez plus d’infos.',
                'picture' => '572dbbda23cd8.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:03:11'),
                'user' => $this->getReference('user_3'),
            ],
            4 => [
                'city' => '',
                'region' => '',
                'message' => '',
                'picture' => '572dbbf05af04.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:03:42'),
                'user' => $this->getReference('user_4'),
            ],
            5 => [
                'city' => '',
                'region' => '',
                'message' => '',
                'picture' => '572dbc2058835.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:04:08'),
                'user' => $this->getReference('user_5'),
            ],
            6 => [
                'city' => '',
                'region' => '',
                'message' => '',
                'picture' => '572dbc30c3b5c.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:05:02'),
                'user' => $this->getReference('user_6'),
            ],
            7 => [
                'city' => '',
                'region' => '',
                'message' => '',
                'picture' => '572dbc41e658b.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:05:49'),
                'user' => $this->getReference('user_7'),
            ],
        ];

        foreach ($users_profiles as $user_profile_data) {
            $users_profile = new UserProfile();
            $users_profile->setCity($user_profile_data['city']);
            $users_profile->setRegion($user_profile_data['region']);
            $users_profile->setMessage($user_profile_data['message']);
            $users_profile->setPicture($user_profile_data['picture']);
            $users_profile->setUpdatedAt($user_profile_data['updated_at']);
            $users_profile->setUser($user_profile_data['user']);

            $manager->persist($users_profile);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}