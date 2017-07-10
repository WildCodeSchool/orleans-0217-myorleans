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
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Tag;
use MyOrleansBundle\Entity\TypeArticle;
use MyOrleansBundle\Entity\Ville;

class LoadResidenceData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ville = new Ville();

        $res = new Residence();
        $res->setNom('Dunois');
        $res->setAdresse('1 rue Bannier');
        $res->setCodePostal('45000');

        $manager->persist($res);

        $res2 = new Residence();
        $res2->setNom('Coté Sud');
        $res2->setAdresse('12, rue Emile Zola');
        $res2->setCodePostal('45000');

        $manager->persist($res2);

        $res3 = new Residence();
        $res3->setNom('Les Terrasses du Loiret');
        $res3->setAdresse('1 rue du Champ de Mars');
        $res3->setCodePostal('45000');

        $manager->persist($res3);

        $res4 = new Residence();
        $res4->setNom('Private');
        $res4->setAdresse('1 rue de Montauban');
        $res4->setCodePostal('45000');

        $manager->persist($res4);


        $manager->flush();

    }

}