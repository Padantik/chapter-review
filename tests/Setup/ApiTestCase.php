<?php

declare(strict_types=1);

namespace App\Tests\Setup;

use App\Entity\Content\Character\CharacterRace;
use App\Entity\Content\Character\CharacterStatus;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiTestCase extends WebTestCase
{
    protected EntityManagerInterface $entityManager;

    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $this->entityManager = $entityManager;

        $this->clearData();
        $this->setData();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearData();
    }

    protected function setData(): void
    {
        foreach (CharacterRace::DEFAULTS as $race) {
            $this->entityManager->persist((new CharacterRace($race))->setName($race));
        }        

        foreach (CharacterStatus::DEFAULTS as $status) {
            $this->entityManager->persist((new CharacterStatus($status))->setName($status));
        }

        $this->entityManager->flush();
    }

    protected function clearData(): void
    {
        if (0 === \count($this->entityManager->getConnection()->createSchemaManager()->listTables())) {
            $schema = new SchemaTool($this->entityManager);
            $schema->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
        }

        $this->entityManager->getConnection()->executeStatement("SET foreign_key_checks = 0;");

        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();

        $this->entityManager->getConnection()->executeStatement("SET foreign_key_checks = 1;");
    }
}