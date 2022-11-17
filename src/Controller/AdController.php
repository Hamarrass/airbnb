<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    #[Route('/ads', name: 'ads_index')]
    public function index(AdRepository $repo): Response
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Permet de créer une annonce
     */
     #[Route('/ads/new',name:"ads_create")]

     public function create(Request $req,EntityManagerInterface  $manager){
       $ad   = new Ad();



       $form  = $this->createForm(AdType::class,$ad);
       $form->handleRequest($req);

                
       if($form->isSubmitted() && $form->isValid()){

         foreach ($ad->getImages() as $image) {
             $image->setAd($ad);
             $manager->persist($image);
         }

           $manager->persist($ad);
           $manager->flush();

           $this->addFlash(
            'success',
            "L'annonce <strong>Test</Strong> a bien été enregistrée!"
        );
           return $this->redirectToRoute('ads_show',[
              'slug'=>$ad->getSlug()
           ]);
       }
   
         return $this->render('ad/new.html.twig',
        [
            'form'=>$form->createView()
        ]);
     }

     /**
      * Permer d'afficher le formulaire d'édition
      */
      #[Route('/ads/{slug}/edit',name:"ads_edit")]

      public function edit(Ad $ad,Request $req ,EntityManagerInterface  $manager){
           
        
       $form  = $this->createForm(AdType::class,$ad);
       $form->handleRequest($req);
                 
       if($form->isSubmitted() && $form->isValid()){

        foreach ($ad->getImages() as $image) {
            $image->setAd($ad);
            $manager->persist($image);
        }

          $manager->persist($ad);
          $manager->flush();

          $this->addFlash(
           'success',
           "Les modifications de l'annonce <strong>Test</Strong> a bien été enregistrée!"
       );
          return $this->redirectToRoute('ads_show',[
             'slug'=>$ad->getSlug()
          ]);
      }

          return $this->render('ad/edit.html.twig',[
              'form'=>$form->createView(),
              'ad'  => $ad
          ]);
      }

    /** 
     * Permet d'afficher une seule annonce
     * @return Response
     */
     #[Route('/ads/{slug}',name:'ads_show')]


     public function show(Ad $ad){
         //Je récupère l'annonce qui correspond au slug !
      
         return $this->render('ad/show.html.twig',
         [
             'ad'=>$ad
         ]);
     }


}  
