<?php

declare(strict_types=1);

namespace App\Repository\Content;

use App\Entity\Content\Character\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 *
 * @method Character|null find($id, $lockMode = null, $lockVersion = null)
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 * @method Character[]    findAll()
 * @method Character[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterRepository extends ServiceEntityRepository
{
    public const ALIAS = 'c';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    public function findBySlug(string $slug): ?Character
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function applyFirstNameFilterToQueryBuilder(QueryBuilder $queryBuilder, ?string $firstName = null): QueryBuilder
    {
        if (null === $firstName || '' === $firstName) {
            return $queryBuilder;
        }

        return $queryBuilder
            ->andWhere(sprintf('%s.firstName LIKE :firstName', self::ALIAS))
            ->setParameter('firstName', sprintf('%%%s%%', $firstName));
    }

    public function applyLastNameFilterToQueryBuilder(QueryBuilder $queryBuilder, ?string $lastName = null): QueryBuilder
    {
        if (null === $lastName || '' === $lastName) {
            return $queryBuilder;
        }

        return $queryBuilder
            ->andWhere(sprintf('%s.lastName LIKE :lastName', self::ALIAS))
            ->setParameter('lastName', sprintf('%%%s%%', $lastName));
    }

    public function applyRaceFilterToQueryBuilder(QueryBuilder $queryBuilder, ?string $race = null): QueryBuilder
    {
        return $queryBuilder;
    }

    public function applyStatusFilterToQueryBuilder(QueryBuilder $queryBuilder, ?string $status = null): QueryBuilder
    {
        return $queryBuilder;
    }
}
