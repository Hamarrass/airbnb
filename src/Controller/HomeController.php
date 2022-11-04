<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/hello/{prenom}/age/{age}",name="hello")
     * @Route("/hello",name="hello_base")
     * @Route("/hello/{prenom}",name="hello_prenom")
     * Montre la page qui dit bonjour
     * 
     * @return void
     */
    
     public function hello($prenom= "Anonyme",$age= 0){
         return $this->render(
             "hello.html.twig",
                    [
                        "prenom"=>$prenom,
                        "age"   =>$age
                    ]
             );
     }

    /**
     *@Route("/",name="homepage")
     */
    public function home(){
       $prenoms = ["Lior"=>31,"Joseph"=>12,"Anne"=>55];
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à tous",
                'age'=>3,
                'tableau' => $prenoms
            ]
        );
    }
}