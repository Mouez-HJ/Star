<?php

namespace CatalogueBundle\Controller;

use CatalogueBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
/**
 * @Route("/addProduit/{nom}/{prix}")
 */
    public function addProduitAction($nom,$prix){
        $p= new  Produit();
        $p->setNom($nom);
        $p->setPrix($prix);
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        return $this->render('CatalogueBundle:Default:addproduit.html.twig',array('produit'=>$p));
    }
    
    
    /**
     * @Route("/listeProduits" , name="liste")
     */
    public function listeProduitAction()
    {
        $produits = $this->getDoctrine()->getRepository("CatalogueBundle:Produit")->findAll();
        
        return $this->render('CatalogueBundle:Default:listeproduit.html.twig',array('produits'=>$produits));
    }
    
    
    /**
     * @Route("/formProduit")
     */
    public function formProduitAction(Request $request)
    {
        $p=new Produit();
        //g�n�rer le formulaire
        
        $form=$this->createFormBuilder($p)
            ->add('nom',TextType::class)
            ->add('prix',TextType::class)
            ->add('Add',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        
        //tester si le formuaire est valide
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            //aller � la vue liste des produits
            return $this->redirect($this->generateUrl("liste"));
        }
        
        return $this->render('CatalogueBundle:Default:formproduit.html.twig',array('f' => $form->createView()));
    }
}
    
    
