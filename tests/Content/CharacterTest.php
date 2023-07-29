<?php

declare(strict_types=1);

namespace App\Tests\Content;

use App\Entity\Content\Character\Character;
use App\Entity\Content\Character\CharacterRace;
use App\Entity\Content\Character\CharacterStatus;
use App\Tests\Setup\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CharacterTest extends ApiTestCase
{
    public function test_it_returns_characters(): void
    {
        $this->create_characters();

        $this->client->jsonRequest(Request::METHOD_GET, '/content/characters');

        $response = $this->client->getResponse();

        self::assertSame(Response::HTTP_OK, $response->getStatusCode());
    }

    protected function create_characters(int $characterCount = 10): void
    {
        /** @var CharacterStatus $status */
        $status = $this->entityManager->getRepository(CharacterStatus::class)->findOneBy(['name' => CharacterStatus::ALIVE]);

        /** @var CharacterRace $race */
        $race = $this->entityManager->getRepository(CharacterRace::class)->findOneBy(['name' => CharacterRace::HAHAOYAN]);

        for ($index = 1; $index <= $characterCount; $index++) {
            $character = (new Character())
                ->setFirstName(sprintf('character%s', $index))
                ->setSlug(sprintf('slug%s', $index))
                ->setAge(rand($index, $index * $index))
                ->setStatus($status)
                ->setRace($race);

            $this->entityManager->persist($character);
        }

        $this->entityManager->flush();
    }
}