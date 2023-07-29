<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Content\Character\Character;

class CharacterDto
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