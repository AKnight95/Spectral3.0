<?php

namespace App\DataFixtures;

use App\Entity\Personnages2 as EntityPersonnages2;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class Personnages2 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {
            $personnages = new EntityPersonnages2();
            $personnages->setNom($faker-> name);
            $manager->persist($personnages);
         }
 
         $manager->flush();

        $manager->flush();
    }
}
