<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Content\Character\Character;
use App\Form\Content\Character\CharacterIndexType;
use App\Repository\Content\CharacterRepository;
use App\Resource\IndexQueryResource;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/content', 'content_character_')]
class CharacterController extends AbstractFOSRestController
{
    public function __construct(
        protected CharacterRepository $characterRepository,
        protected IndexQueryResource $indexQueryResource,
    ) {}

    #[Route('/characters', 'index', methods: Request::METHOD_GET)]
    public function index(Request $request): Response
    {
        $form = $this
            ->createForm(CharacterIndexType::class)
            ->submit($request->query->all());

        if ($form->isValid()) {
            $queryBuilder = $this->characterRepository->createQueryBuilder(CharacterRepository::ALIAS);

            $queryBuilder = $this->characterRepository->applyFirstNameFilterToQueryBuilder($queryBuilder, $form->get('firstName')->getData());

            $view = $this->indexQueryResource->createViewFromQueryBuilder($queryBuilder, $form);
        } else {
            $view = $this->view($form);
        }

        return $this->handleView($view);
    }

    #[Route('/character/{slug}', 'show', methods: Request::METHOD_GET)]
    public function show(string $slug): Response
    {
        if (null === $character = $this->characterRepository->findBySlug($slug)) {
            throw new NotFoundHttpException(sprintf('Character "%s" not found.', $slug));  
        }

        return $this->handleView($this->view($character));
    }

    #[Route('/character', 'create', methods: Request::METHOD_POST)]
    public function create(Request $request): Response
    {
        $character = new Character();

        $form = $this
            ->createForm(CharacterType::class, $character)
            ->submit($request->request->all());

        if ($form->isValid()) {
            
        } else {

        }
    }

    #[Route('/character/{slug}', 'update', methods: Request::METHOD_PUT)]
    public function update(string $slug): Response
    {
        if (null === $character = $this->characterRepository->findBySlug($slug)) {
            throw new NotFoundHttpException(sprintf('Character "%s" not found.', $slug));  
        }
    }

    #[Route('/character/{slug}', 'delete', methods: Request::METHOD_DELETE)]
    public function delete(string $slug): Response
    {
        if (null === $character = $this->characterRepository->findBySlug($slug)) {
            throw new NotFoundHttpException(sprintf('Character "%s" not found.', $slug));  
        }
    }
}