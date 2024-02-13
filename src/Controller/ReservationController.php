<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\HoraireRepository;
use App\Repository\NombreDeConviveRepository;
use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    public function redirection(
                HoraireRepository $horaireRepository
    ): Response
    {
        $horaires = $horaireRepository->findAll();
    
        return $this->render('reservation/choix.html.twig', [
            
            'horaires' =>  $horaires,
        ]);
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function index(
                Request $request,
                PersistenceManagerRegistry $doctrine,
                HoraireRepository $horaireRepository
    ): Response
    {
        $horaires = $horaireRepository->findAll();
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
            'horaires' =>  $horaires,
        ]);
    }

    #[Route('/-traitement', name: 'traitement')]
    public function traitement(
        ReservationRepository $reservationRepository,
        NombreDeConviveRepository $nombreDeConviveRepository,
    ): Response {

        // récupérer le nombre de place occupée
        $nombre = $reservationRepository->nombreTotalDeConvive();

        // récupérer le nombre de place disponible
        $place = $nombreDeConviveRepository->nombreDePlaceDisponible();

        $query = array_merge($nombre, $place);

        return new JsonResponse($query);
    }
}
