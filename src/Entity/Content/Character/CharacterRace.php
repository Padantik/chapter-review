<?php

declare(strict_types=1);

namespace App\Entity\Content\Character;

use App\Entity\Lookup;
use App\Repository\Content\CharacterRaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRaceRepository::class)]
#[ORM\Table(name: '`character_race`')]
class CharacterRace extends Lookup
{
    public const HAHAOYAN = 'hahaoyan';
    public const MIXED = 'mixed';
    public const KAGANTHI = 'kaganthi';
    public const QAALM = 'qaalm';

    public const DEFAULTS = [self::HAHAOYAN, self::MIXED, self::KAGANTHI, self::QAALM];
}
