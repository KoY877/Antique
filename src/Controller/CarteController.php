<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Plat;
use App\Repository\CategoryRepository;
use App\Repository\HoraireRepository;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(PlatRepository $platRepository, CategoryRepository $categoryRepository, HoraireRepository $horaireRepository): Response
    {
        $plats = $platRepository->findAll();
        $categories = $categoryRepository->findAll();
        $horaires = $horaireRepository->findAll();

        return $this->render('carte/index.html.twig', [
            'plats' => $plats,
            'categories' =>  $categories,
            'horaires' => $horaires,
        ]);
    }

    #[Route('/carte/categorie/{nom}', name: 'app_carte_categorie')]
    public function categorie(
        EntityManagerInterface $entityManger, 
        CategoryRepository $categoryRepository,
        HoraireRepository $horaireRepository,
         $nom
    ): Response {

        $queryBuilder = $entityManger->createQueryBuilder();

        $querys = $queryBuilder->select('p')
                            ->from(Plat::class, 'p')  
                            ->join('p.categories', 'c')
                            ->where('c.nom = :nom')
                            ->setParameter('nom', $nom)
                            ->getQuery()
                            ->getResult()
                            ;
        
        $categories = $categoryRepository->findAll();
        $categorie = $nom;
        $horaires = $horaireRepository->findAll();


        return $this->render('carte/categorie.html.twig', [
            'querys' => $querys,
            'categories' => $categories,
            'categorie' => $categorie,
            'horaires' => $horaires,
        ]);
    }
}
