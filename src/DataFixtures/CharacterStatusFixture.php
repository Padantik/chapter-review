<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Content\Character\CharacterStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CharacterStatusFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (CharacterStatus::DEFAULTS as $status) {
            $manager->persist((new CharacterStatus())->setName($status));
        }

        $manager->flush();
    }
}