<?php

namespace CatalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class DefaultController extends Controller
{
   
    /**
     * @Route("/hello/{name}")
     */
    public function HelloAction($name)
    {
        return $this->render('CatalogueBundle:Default:index.html.twig',array('name' => $name));
    }
    
    /**
     * @Route("/admin/{name}")
     */
    public function adminAction($name)
    {
        return $this->render('CatalogueBundle:Default:index.html.twig',array('name' => $name));
    }
    
    /**
     * @Route("/somme/{a}/{b}")
     */
    public function SommeAction($a,$b)
    {
        $s = $a + $b ;
        return $this->render('CatalogueBundle:Default:somme.html.twig',array('a' => $a , 'b' => $b , 'somme' => $s));
    }
}
