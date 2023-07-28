<?php

declare(strict_types=1);

namespace App\Tests\Setup;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    protected EntityManagerInterface $entityManager;

    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $this->entityManager = $entityManager;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearData();
    }

    private function clearData(): void
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