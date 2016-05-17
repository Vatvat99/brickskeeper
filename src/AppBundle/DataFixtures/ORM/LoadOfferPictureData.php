<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\OfferPicture;

class LoadOfferPictureData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offers_pictures = [
            1 => [
                'offer' => $this->getReference('offer_1'),
                'filename' => '1-picture-1.jpg',
                'updated_at' => new \DateTime('2016-05-07 10:58:43'),
            ],
            2 => [
                'offer' => $this->getReference('offer_1'),
                'filename' => '1-picture-2.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:02:38'),
            ],
            3 => [
                'offer' => $this->getReference('offer_2'),
                'filename' => '2-picture-1.jpg',
                'updated_at' => new \DateTime('2016-05-07 11:03:11'),
            ],
        ];

        $i = 1;
        foreach ($offers_pictures as $offer_picture_data) {
            $offer_picture = new OfferPicture();
            $offer_picture->setOffer($offer_picture_data['offer']);
            $offer_picture->setFilename($offer_picture_data['filename']);
            $offer_picture->setUpdatedAt($offer_picture_data['updated_at']);

            $manager->persist($offer_picture);

            $this->setReference('offer_picture_' . $i, $offer_picture);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }
}