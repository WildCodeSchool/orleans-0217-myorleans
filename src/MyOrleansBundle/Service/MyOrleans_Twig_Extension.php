<?php

namespace MyOrleansBundle\Service;

class MyOrleans_Twig_Extension
{

    public function getFunctions()
    {
        $twig = new \Twig_Environment();
        $twig->addExtension(new \Twig_Extensions_Extension_Text());
    }



}