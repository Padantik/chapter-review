<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Content\Character\CharacterRace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CharacterRaceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (CharacterRace::DEFAULTS as $race) {
            $manager->persist((new CharacterRace())->setName($race));
        }

        $manager->flush();
    }
}