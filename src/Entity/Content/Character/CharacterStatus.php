<?php

declare(strict_types=1);

namespace App\Entity\Content\Character;

use App\Entity\Lookup;
use App\Repository\Content\CharacterStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterStatusRepository::class)]
#[ORM\Table(name: '`character_status`')]
class CharacterStatus extends Lookup
{
    public const ALIVE = 'alive';
    public const DEAD = 'dead';
    public const UNKNOWN = 'unknown';

    public const DEFAULTS = [self::ALIVE, self::DEAD, self::UNKNOWN];
}
