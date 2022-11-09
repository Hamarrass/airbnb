<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

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
