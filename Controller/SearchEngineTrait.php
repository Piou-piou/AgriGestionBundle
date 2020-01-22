<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

trait SearchEngineTrait
{
    /**
     * @param EntityManagerInterface $em
     * @param array $searches
     * @param string $class
     * @return mixed
     */
    public function doSearch(EntityManagerInterface $em, array $searches, string $class)
    {
        /** @var QueryBuilder $query */
        $query = $em->getRepository($class)->createQueryBuilder("query");

        foreach ($searches as $key => $search) {
            if ($search !== "") {
                $query->andWhere("query.".$key . " LIKE :" . $key)->setParameter(":".$key, "%".$search."%");
            }
        }

        return $query->getQuery()->getResult();
    }
}
