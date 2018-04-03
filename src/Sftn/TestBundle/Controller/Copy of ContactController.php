<?php

namespace Sftn\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sftn\TestBundle\Entity\Contact;
use Sftn\TestBundle\Form\ContactType;

class ContactController extends Controller
{
    
  
    public function sendAction(Request $request)
    {   
        $contact = new Contact;
        
        $form = $this->createForm(ContactType::class, $contact);
        
        
        $session = $request->getSession();
        
        if($request->isMethod('Post')){
        
            //$form->bindRequest($request);
           // $form->submit($request);
            $form->handleRequest($request);
            
            if($form->isValid()){
            
                $contact = $form->getData();
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                
                return $this->redirect($this->generateUrl('sftn_test_homepage'));
                
            }
        }
        
        
        return $this->render('SftnTestBundle:Contact:send.html.twig', array('form'=>$form->createView()));
    }
               
}
