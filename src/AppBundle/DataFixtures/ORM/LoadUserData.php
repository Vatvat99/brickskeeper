<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = [
            1 => [
                'lastname' => 'Vattant',
                'firstname' => 'Aurélien',
                'email' => 'aurelien.vattant@gmail.com',
                'password' => 'Aurélien',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-02'),
            ],
        ];

        $i = 1;
        foreach ($users as $user_data) {
            $user = new User();
            $user->setLastname($user_data['lastname']);
            $user->setFirstname($user_data['firstname']);
            $user->setEmail($user_data['email']);
            $user->setPassword($user_data['password']);
            $user->setActivationKey($user_data['activation_key']);
            $user->setActive($user_data['active']);
            $user->setRegistrationDate($user_data['registration_date']);

            $manager->persist($user);

            $this->setReference('user_' . $i, $user);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}