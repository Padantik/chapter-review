<?php

declare(strict_types=1);

namespace App\Repository\Content;

use App\Entity\Content\Character\CharacterStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 *
 * @method Character|null find($id, $lockMode = null, $lockVersion = null)
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 * @method Character[]    findAll()
 * @method Character[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterStatus::class);
    }
}
