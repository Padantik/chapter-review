<?php

declare(strict_types=1);

namespace App\Tests\Content;

use App\Entity\Content\Character\Character;
use App\Tests\Setup\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CharacterTest extends ApiTestCase
{
    public function test_it_returns_characters(): void
    {
        $this->create_characters();

        $this->client->jsonRequest(Request::METHOD_GET, '/characters');

        $response = $this->client->getResponse();

        self::assertSame(Response::HTTP_OK, $response->getStatusCode());
        self::assertSame(10, count(json_decode($response->getContent(), true)));
    }

    private function create_characters(int $characterCount = 10): void
    {
        for ($index = 1; $index <= $characterCount; $index++) {
            $character = (new Character())
                ->setFirstName(sprintf('character%s', $index))
                ->setSlug(sprintf('slug%s', $index))
                ->setAge(rand($index, $index * $index));

            $this->entityManager->persist($character);
        }

        $this->entityManager->flush();
    }
}