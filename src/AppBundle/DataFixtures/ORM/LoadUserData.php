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
                'password' => '$2y$10$L9uK2r/s8ULt2YqZ4zYSwe9aaMoZGwzP0/wec.e.cRp5hR44UP6Ju',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-02'),
            ],
            2 => [
                'lastname' => 'Raymont',
                'firstname' => 'George',
                'email' => 'george.raymont@gmail.com',
                'password' => '$2y$13$m8bzDyya3qYx/JxwhaNWpuC83vtOOaY.VEFnhd2a3ypQTyzTQuzLm',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
            ],
            3 => [
                'lastname' => 'Deslanges',
                'firstname' => 'Julie',
                'email' => 'julie.deslanges@gmail.com',
                'password' => '$2y$13$nRlzh36kYu0i40wRD8toIuhlBtZqHicwP8l7thNkqazTfis.nGAEW',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
            ],
            4 => [
                'lastname' => 'Desmont',
                'firstname' => 'Marie',
                'email' => 'marie.desmont@gmail.com',
                'password' => '$2y$13$PvcIaU39JjRg50V/s8mzeuhdQvdX1ZxtjrOpM.2mmUBRLZIM.XWdG',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
            ],
            5 => [
                'lastname' => 'Dumesnil',
                'firstname' => 'Céline',
                'email' => 'celine.dumesnil@gmail.com',
                'password' => '$2y$13$ImMIwpuz6dCoGPgLcXi2su8SVaE8RQyrhc25m3/rppzmhjSGnB1S2',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
            ],
            6 => [
                'lastname' => 'Blanc',
                'firstname' => 'Marjorie',
                'email' => 'marjorie.blanc@gmail.com',
                'password' => '$2y$13$UiT7lsk4sl3dNIkqyCIdA.H6G8.eUm/u8lXFfQ.4RFYVyXM2T3jRS',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
            ],
            7 => [
                'lastname' => 'Meunier',
                'firstname' => 'Jérome',
                'email' => 'jerome.meunier@gmail.com',
                'password' => '$2y$13$CmAR4JN4j9n5flKqT1vWiOkoBEdCBo1ds31z2hkHo3ousfgmL3xQO',
                'activation_key' => '',
                'active' => 1,
                'registration_date' => new \DateTime('2016-04-30'),
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