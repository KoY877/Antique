<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ImageRepository $imageRepository, HoraireRepository $horaireRepository): Response
    {
        $images = $imageRepository->findAll();
        $horaires = $horaireRepository->findAll();

        return $this->render('page/home.html.twig', [
            'images' => $images,
            'horaires' => $horaires,
        ]);
    }
}
