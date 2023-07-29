<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/content/character', 'content_character_race_')]
class CharacterRaceController extends AbstractController
{
    #[Route('/races', 'index', methods: Request::METHOD_GET)]
    public function index(): Response
    {
        dd('d');
    }
}