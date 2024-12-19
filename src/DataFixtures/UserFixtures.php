<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
            $user->setLibelle("Article $i")
                    ->setPrix(10.5 * $i)
                    ->setQteStock(100 * $i);

            $manager->persist($user);

        $manager->flush();
    }
}
