<?php

namespace App\DataFixtures;

use App\Entity\Trm;
use App\Entity\TrmVersion;
use App\Entity\Section;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $trm = new Trm();
         $version1 = new TrmVersion();
         $version2 = new TrmVersion();
         $version3 = new TrmVersion();
         $section1 = new Section;
         $section2 = new Section;

         $trm->setName('LP du Hainaut 2022-2023');
         $trm->setDescription("Basé sur la structure du 11/11/2022 calcul des besoins pour l'année scolaire 2022-2023");

         $version1->setName('Version de base LP');
         $version1->setTrm($trm);
         $version2->setName('Autre version LP');
         $version2->setTrm($trm);
         $version3->setName('Troisième version LP');
         $version3->setTrm($trm);

         $section1->setNom('Bac pro TCI');
         $section2->setNom('Bac pro MELEC');

         $manager->persist($trm);
         $manager->persist($version1);
         $manager->persist($version2);
         $manager->persist($version3);
         $manager->persist($section1);
         $manager->persist($section2);

        $trm2 = new Trm();
        $version21 = new TrmVersion();
        $version22 = new TrmVersion();
        $trm2->setName('LGT du Hainaut 2022-2023');
        $trm2->setDescription("TRM LGT Basé sur la structure du 11/11/2022 calcul des besoins pour l'année scolaire 2022-2023");

        $version21->setName('Version de base LGT');
        $version21->setTrm($trm2);
        $version22->setName('Autre version LGT');
        $version22->setTrm($trm2);

        $manager->persist($trm2);
        $manager->persist($version21);
        $manager->persist($version22);

        $manager->flush();
    }
}
