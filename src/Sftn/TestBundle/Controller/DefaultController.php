<?php

namespace Sftn\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
   
    public function indexAction()
    {
        return $this->render('SftnTestBundle:Default:index.html.twig');
    }
                
               
}
