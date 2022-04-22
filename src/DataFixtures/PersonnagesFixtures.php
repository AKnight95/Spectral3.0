<?php

namespace App\DataFixtures;

use App\Entity\Personnages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PersonnagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {
            $personnages = new Personnages();
            $personnages->setNom($faker-> name);
            $manager->persist($personnages);
         }
 
         $manager->flush();
    }
}
