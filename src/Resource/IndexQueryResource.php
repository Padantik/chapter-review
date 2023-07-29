<?php 

declare(strict_types=1);

namespace App\Resource;

use Doctrine\ORM\QueryBuilder;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;

class IndexQueryResource
{
    public function createViewFromQueryBuilder(QueryBuilder $queryBuilder, FormInterface $form): View
    {
        dd($form->getData());

        // $queryBuilder
        //     ->setMaxResults()

        return View::create($queryBuilder->getQuery()->getArrayResult());
    }
}