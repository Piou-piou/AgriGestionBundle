<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

trait SearchEngineTrait
{
    /** @var EntityManagerInterface */
    private $em;

    private $searches;

    /**
     * @param EntityManagerInterface $em
     * @param array $searches
     * @param string $class
     * @return mixed
     */
    public function doSearch(EntityManagerInterface $em, array $searches, string $class)
    {
        $this->em = $em;
        $this->searches = $searches;
        $entity_fields = $this->getEntityFields($class);

        /** @var QueryBuilder $query */
        $query =  $this->em->getRepository($class)->createQueryBuilder("query");

        foreach ($searches as $key => $search) {
            if ($search !== "") {
                $this->getQuerySearchElements($query, $entity_fields[$key], $key, $search);
            }
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @return array
     */
    private function getSearches(): array
    {
        return $this->searches;
    }

    /**
     * @param QueryBuilder $query
     * @param array $entity_field_infos
     * @param string $key
     * @param string $search
     * @return QueryBuilder
     */
    private function getQuerySearchElements(QueryBuilder $query, array $entity_field_infos, string $key, string $search): QueryBuilder
    {
        switch ($entity_field_infos["type"]) {
            case "string":
                $condition = "query.".$key . " LIKE :" . $key;
                $parameter = "%".$search."%";
                break;
            default:
                $condition = false;
                $parameter = false;
                break;
        }

        if ($condition && $parameter) {
            return $query->orWhere($condition)->setParameter(":".$key, $parameter);
        }

        return $query;
    }

    /**
     * get entity fields type of given entity
     * @param $class
     * @return array
     */
    private function getEntityFields($class): array
    {
        $metadata = $this->em->getClassMetadata($class);
        $mappings = $metadata->getAssociationMappings();
        $entity_fields = $metadata->getFieldNames();
        $fields = [];

        foreach ($entity_fields as $entity_field) {
            $fields[$entity_field] =  [
                "type" => $metadata->getTypeOfField($entity_field)
            ];
        }

        return $fields;
    }
}
