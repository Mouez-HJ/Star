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
                
                 // envoyer l'email
                if($this->sendEmail($form->getData())){
                    
                    // Everything OK, redirect to wherever you want ! :
                    
                   return $this->redirect($this->generateUrl('sftn_test_homepage'));
                   
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor :(");
                }
                
               
                
               
                
            }
        }
        
        
        return $this->render('SftnTestBundle:Contact:send.html.twig', array('form'=>$form->createView()));
    }
    
    
    
    private function sendEmail($data){
        $myappContactMail = 'devlabes@gmail.com';
        $myappContactPassword = 'azoo0404911';
        
        // In this case we'll use the ZOHO mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587,'ssl')
        ->setUsername($myappContactMail)
        ->setPassword($myappContactPassword);
        
        $mailer = \Swift_Mailer::newInstance($transport);
        
        $message = \Swift_Message::newInstance()
        ->setFrom($data['email'])
        ->setTo( $myappContactMail)
        ->setBody($data["message"]."<br>ContactMail :".$data["email"]);
        
        return $mailer->send($message);
    }
               
}
