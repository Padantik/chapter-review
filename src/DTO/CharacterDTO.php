<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Content\Character\Character;

class CharacterDTO
{
    public function buildFromEntity(Character $character): array
    {
        return [
            'firstName' => $character->getFirstName(),
            'lastName' => $character->getLastName(),
            'slug' => $character->getSlug(),
            'age' => $character->getAge(),
        ];
    }
}