<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiLoginController extends AbstractController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager, private Security $security, TokenStorageInterface $tokenStorageInterface)
    {
        $this->jwtManager = $jwtManager;
    }

    
    #[Route(path:'/api/login_check', name: 'login_check')]
    public function create_token() : Response
    {
        if($this->getUser() instanceof UserInterface)
        {
            $user = $this->getUser();

            $token = $this->jwtManager->create($user);

            return new JsonResponse(['user' => $user->getUserIdentifier(), "token" => $token],Response::HTTP_OK);
        }else
        {
            // Retourner le jeton dans une réponse JSON
            return $this->json(['message' => 'Vous n´êtez pas connecté.'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
