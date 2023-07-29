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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    public function findBySlug(string $slug): ?Character
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function applyFirstNameFilterToQueryBuilder(QueryBuilder $queryBuilder, string $rootAlias, ?string $firstName): QueryBuilder
    {
        return $queryBuilder;
    }

    public function applyLastNameFilterToQueryBuilder(QueryBuilder $queryBuilder, string $rootAlias, ?string $lastName): QueryBuilder
    {
        return $queryBuilder;
    }

    public function applyRaceFilterToQueryBuilder(QueryBuilder $queryBuilder, string $rootAlias, ?string $race): QueryBuilder
    {
        return $queryBuilder;
    }

    public function applyStatusFilterToQueryBuilder(QueryBuilder $queryBuilder, string $rootAlias, ?string $status): QueryBuilder
    {
        return $queryBuilder;
    }
}
