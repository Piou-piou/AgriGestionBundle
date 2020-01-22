<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

trait SearchEngineTrait
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param EntityManagerInterface $em
     * @param array $searches
     * @param string $class
     * @return mixed
     */
    public function doSearch(EntityManagerInterface $em, array $searches, string $class)
    {
        $this->em = $em;
        $entity_fields = $this->getEntityFields($class);

        /** @var QueryBuilder $query */
        $query =  $this->em->getRepository($class)->createQueryBuilder("query");

        foreach ($searches as $key => $search) {
            if ($search !== "") {
                if ($entity_fields[$key] === "string") {
                    $query->andWhere("query.".$key . " LIKE :" . $key)->setParameter(":".$key, "%".$search."%");
                }
            }
        }

        return $query->getQuery()->getResult();
    }

    /**
     * get entity fields type of given entity
     * @param $class
     * @return array
     */
    private function getEntityFields($class): array
    {
        $metadata = $this->em->getClassMetadata($class);
        $entity_fields = $metadata->getFieldNames();
        $fields = [];

        foreach ($entity_fields as $entity_field) {
            $fields[$entity_field] = $metadata->getTypeOfField($entity_field);
        }

        return $fields;
    }
}
