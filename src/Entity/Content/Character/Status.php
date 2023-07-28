<?php

declare(strict_types=1);

namespace App\Entity\Content\Character;

use App\Entity\Lookup;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'character_status')]
#[ORM\Entity]
class Status extends Lookup
{
    public const ALIVE = 'alive';
    public const DEAD = 'dead';
    public const UNKNOWN = 'unknown';

    public const ALL = [self::ALIVE, self::DEAD, self::UNKNOWN];
}
