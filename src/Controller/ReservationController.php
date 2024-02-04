<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\NombreDeConviveRepository;
use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(
                Request $request,
                PersistenceManagerRegistry $doctrine,
                       
    ): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
       
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid())
        {
            //  Date de création
            $now = new DateTime();
            $reservation->setCreatedAt($now);

            // Entity Manager
            $em = $doctrine->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirect($this->generateUrl('app_reservation'));
        }
    
        return $this->render('reservation/index.html.twig', [
            'reservation' => $form->createView(),
        ]);
    }

    #[Route('/-traitement', name: 'traitement')]
    public function traitement(
        ReservationRepository $reservationRepository,
        NombreDeConviveRepository $nombreDeConviveRepository,
        Security $security
    ): Response {

        //  Récupération les donnéees de l'utilisateur
        $user = $security->getUser();
        // Si l'utilisateur n'est pas connecté on le redirige vers la page d'authentification
        // if (!$user) {
        //     return $this->redirectToRoute('app_login');
        // }

        $nombre = $reservationRepository->nombreTotalDeConvive();
        $place = $nombreDeConviveRepository->nombreDePlaceDisponible();

        $query = array_merge($nombre, $place);

        return new JsonResponse($query);
    }
}
