<?php

declare(strict_types=1);

namespace App\Entity\Content\Character;

use App\Entity\Lookup;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'character_race')]
#[ORM\Entity]
class Race extends Lookup
{
    public const HAHAOYAN = 'hahaoyan';
    public const MIXED = 'mixed';
    public const KAGANTHI = 'kaganthi';
    public const QAALM = 'qaalm';

    public const ALL = [self::HAHAOYAN, self::MIXED, self::KAGANTHI, self::QAALM];
}
