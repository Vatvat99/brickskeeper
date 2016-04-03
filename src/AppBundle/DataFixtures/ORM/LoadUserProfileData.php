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
                'picture' => '1-aurelien-vattant.png',
                'user' => $this->getReference('user_1'),
            ],
        ];

        foreach ($users_profiles as $user_profile_data) {
            $users_profile = new UserProfile();
            $users_profile->setCity($user_profile_data['city']);
            $users_profile->setRegion($user_profile_data['region']);
            $users_profile->setMessage($user_profile_data['message']);
            $users_profile->setPicture($user_profile_data['picture']);
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