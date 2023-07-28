<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CharacterDTO;
use App\Entity\Content\Character\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    public function __construct(
        protected CharacterDTO $characterDto,
        protected CharacterRepository $characterRepository,
    ) {}

    #[Route('/characters', methods: Request::METHOD_GET)]
    public function index(Request $request): Response
    {
        $characters = $this->characterRepository->findAll();

        return $this->render(
            'index.html.twig',
            ['results' => array_map(fn (Character $character) => $this->characterDto->buildFromEntity($character), $characters)],
        );
    }

    #[Route('/character/{slug}', methods: Request::METHOD_GET)]
    public function show(string $slug): Response
    {
        if (null !== $character = $this->characterRepository->findBySlug($slug)) {
            return $this->render(
                'show.html.twig',
                ['result' => $this->characterDto->buildFromEntity($character)],
            );
        }

        throw new NotFoundHttpException(sprintf('Character "%s" not found.', $slug));
    }

    #[Route('/character', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function create(Request $request): Response
    {
        $character = new Character();

        $form = $this
            ->createForm(CharacterType::class, $character)
            ->submit($request->request->all());

        if ($form->isValid()) {
            
        } else {
            return $this->render('form/base_form.html.twig');
        }
    }
}