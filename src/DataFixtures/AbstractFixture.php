<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture as DoctrineAbstractFixture;

abstract class AbstractFixture extends DoctrineAbstractFixture
{
    protected array $fixtures;

    protected ?string $referenceFormat = null;

    public function __construct(array $fixtures)
    {
        $this->fixtures = $fixtures;
    }
}