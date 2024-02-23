<?php
namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route("/inscription", name: "inscription")]
    public function inscription(EntityManagerInterface $em, Request $request)
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($inscription);
            $em->flush();

            // Ajouter un message flash pour indiquer que le formulaire a été soumis avec succès
            $this->addFlash('success', 'Votre inscription a été enregistrée avec succès.');

            return $this->redirectToRoute("home");
        }

        return $this->render("front/inscription.html.twig", ["form" => $form->createView()]);
    }
}
