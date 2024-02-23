<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController{

  #[Route("/", name: "home")]//1ère valeur => barre de navigation, 2ème valeur => lien du menu
  public function home(){
  return $this->render("front/home.html.twig");
  }


}