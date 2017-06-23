<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 19/06/17
 * Time: 22:48
 */

namespace MyOrleansBundle\Service;


use MyOrleansBundle\Entity\Residence;

class AutocompleteGenerator
{
    public function findVilles($residences)
    {
        $villes = [];
        foreach ($residences as $residence) {
            $villes[] = $residence->getVille();
        }

        return $villes;
    }

    public function findQuartiers($residences)
    {
        $quartiers = [];
        foreach ($residences as $residence) {
            $quartiers[] = $residence->getQuartier();
        }

        return $quartiers;
    }

}