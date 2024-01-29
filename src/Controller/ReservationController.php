<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(
                Request $request, 
                PersistenceManagerRegistry $doctrine
    ): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        // $form = $this->createFormBuilder()
        //     ->add('nom', TextType::class, [
        //         'label' => 'Nom : ',
        //     ])
        //     ->add('nombreDeConvive', NumberType::class, [
        //         'label' => 'Nombres de convives :',
        //     ])
        //     ->add('date', DateType::class, [ 
        //         'label' => "Date : ",
        //     ])
        //     ->add('heurePrevue', TextType::class)
        //     ->add('minutePrevue', TextType::class)
        //     ->add('mentionDesAllergies', TextType::class, [
        //         'label' => 'J\'ai une ou plusieurs allergies : '
        //     ])
        //     ->add('submit', SubmitType::class, [
        //         'label' => 'S\'inscrire',
        //     ])
        //     ->getForm()
        // ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // $infoSaisi = $form->getData();

            // $reservation = new Reservation();

            // $reservation->setNom($infoSaisi['nom']);
            // $reservation->setNombreDeConvive($infoSaisi['nombreDeConvive']);
            // $reservation->setDate( $infoSaisi['date']);
            // $reservation->setHeurePrevue($infoSaisi['heurePrevue']);
            // $reservation->setMinutePrevue($infoSaisi['minutePrevue']);

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
}
