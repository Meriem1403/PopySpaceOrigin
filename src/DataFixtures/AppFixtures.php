<?php

namespace App\DataFixtures;

use App\Factory\PlaneteFactory;
use App\Factory\VoyageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 5 planètes aléatoires dans la Voie lactée
        PlaneteFactory::createMany(5);

        // 2 planètes hors Voie lactée avec noms spécifiques
        PlaneteFactory::createMany(2, function () {
            $noms = PlaneteFactory::AUTRES_NOMS;

            return [
                'dansVoieLactee' => false,
                'nom' => $noms[array_rand($noms)],
            ];
        });

        // 30 voyages associés à des planètes aléatoires
        VoyageFactory::createMany(30, function () {
            return [
                'planete' => PlaneteFactory::random(),
            ];
        });

        $manager->flush();
    }
}
