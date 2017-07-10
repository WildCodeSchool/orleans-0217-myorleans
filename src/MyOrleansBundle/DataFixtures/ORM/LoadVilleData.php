<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 10/07/17
 * Time: 18:48
 */

namespace MyOrleansBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyOrleansBundle\Entity\TypeArticle;
use MyOrleansBundle\Entity\Ville;

class LoadVilleData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ville1 = new Ville();
        $ville2 = new Ville();
        $ville3 = new Ville();


        $ville1->setNom('Orléans');
        $ville2->setNom('Saran');
        $ville3->setNom('Olivet');


        $manager->persist($ville1);
        $manager->persist($ville2);
        $manager->persist($ville3);

        $manager->flush();

    }

}