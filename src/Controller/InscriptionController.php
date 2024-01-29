<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ClientInscriptionType;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(
                Request $request, 
                PersistenceManagerRegistry $doctrine): Response
    {   
        $inscription = new User();

        $form = $this->createForm(ClientInscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // Entity Manager
            $em = $doctrine->getManager();
            $em->persist($inscription);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }
       
        return $this->render('inscription/index.html.twig', [
            'inscription' => $form->createView(),
        ]);
    }
}
