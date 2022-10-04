<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Core\Security;
use App\Entity\Customer;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ping extends AbstractController
{

    #[Route('/auth/ping', name: 'app_api_ping')]
    public function indexAction(): JsonResponse
    {
        return new JsonResponse(["result" => 'Pong']);
    }

    #[Route('/auth/profile', name: 'app_api_profile')]
    public function profileAction(): JsonResponse
    {
        // if( $customer !== null )
        // {
        //     return new JsonResponse([$customer->getEmail()]);
        // }
        // if( $user !== null )
        // {
        //     return new JsonResponse([$user->getEmail()]);
        // }

        return new JsonResponse($this->getUser()->getRoles());
    }
}