<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Person;
use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Data extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr');
        for ($i = 0; $i < 10; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setDesignation($faker->company);
            $pfe = new PFE();
            $pfe->setTitre($faker->title);
            $pfe->setNomEtudiant($faker->name);
            $pfe->setEntreprise($entreprise);

            $manager->persist($entreprise);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
