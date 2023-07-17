<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CharacterController extends AbstractController
{
    // public function __construct(
    //     protected 
    // ) {}

    #[Route('/characters')]
    public function index(Request $request): Response
    {
        dd($request);
    }
}