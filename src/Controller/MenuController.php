<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(MenuRepository $menuRepository, HoraireRepository $horaireRepository): Response
    {
        $menus = $menuRepository->findAll();
        $horaires = $horaireRepository->findAll();
        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            'horaires' => $horaires,
        ]);
    }
}
