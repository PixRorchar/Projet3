<?php

namespace App\DataFixtures;

use App\Entity\Alim;
use App\Entity\Gr;
use App\Entity\Groupe;
use App\Entity\Sougr;
use App\Entity\SousGroupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {     
        for ($k = 1; $k < 3; $k++) {
            $gr = new Groupe();

            $gr->setGroupe('Group n°' . $k)
                ->setCode($k);

            $manager->persist($gr);
      
            for ($j = 1; $j < mt_rand(2, 3); $j++) {
                $sougr = new SousGroupe();

                $sougr->setSougr('Sougr n°' . $j)
                    ->setCode($j)
                    ->setGroupe($gr);

                $manager->persist($sougr);     
                
                for ($i = 1; $i <= mt_rand(4, 10); $i++) {
                    $alim = new Alim();

                    $alim->setLibal('Alim n°' . $i)
                        ->setCode($i)
                        ->setSousGroupe($sougr);

                    $manager->persist($alim);               
                }
            }
        }
        $manager->flush();
    }
    /*
    public function loads(ObjectManager $manager, Gr $gr)
    {
        for ($j = 0; $j < 4; $j++) {
            $sougr = new Sougr();
            $sougr->setSougr($j);
            $sougr->setLibsougr('Sougr' . $j);
            $sougr->setGr($gr);
            $manager->persist($sougr);
        }
        $manager->flush();
    }
    public function loadss(ObjectManager $manager, Sougr $sougr)
    {
        for ($i = 0; $i < 20; $i++) {
            $alim = new Alim();
            $alim->setLibal('Alim' . $i);
            $alim->setCodal($i);
            $alim->setSouGr($sougr);
            $manager->persist($alim);
        }
        $manager->flush();
    }
*/
}
