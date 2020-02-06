<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\MappingException;
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
     * @throws MappingException
     */
    public function doSearch(EntityManagerInterface $em, array $searches, string $class)
    {
        $this->em = $em;
        $this->searches = $searches;
        $entity_fields = $this->getEntityFields($class);

        /** @var QueryBuilder $query */
        $query = $this->em->getRepository($class)->createQueryBuilder("query");

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
                $condition = "query." . $key . " LIKE :" . $key;
                $parameter = "%" . $search . "%";
                $query->orWhere($condition)->setParameter(":" . $key, $parameter);
            case "integer":
                if ($entity_field_infos["entity_field_name"]) {
                    $alias = substr($entity_field_infos["entity_field_name"], 0, 3);
                    $query->join('query.provider', $alias);

                    foreach ($entity_field_infos["joined_entity_fields"] as $joined_key => $joined_field) {
                        $condition = $alias."." . $joined_key . " LIKE :" . $joined_key;
                        $parameter = "%" . $search . "%";
                        $query->orWhere($condition)->setParameter(":" . $joined_key, $parameter);
                    }
                }
            default:
                break;
        }

        return $query;
    }

    /**
     * get entity fields type of given entity
     * @param $class
     * @return array
     * @throws MappingException
     */
    private function getEntityFields($class): array
    {
        $metadata = $this->em->getClassMetadata($class);
        $mappings = $metadata->getAssociationMappings();
        $entity_fields = $metadata->getFieldNames();
        $fields = [];

        foreach ($mappings as $mapping) {
            $metadata_target = $this->em->getClassMetadata($mapping["targetEntity"]);
            $joined_entity_fields = $this->getJoinedEntityFields($metadata_target, $metadata_target->reflClass);

            if (count($joined_entity_fields)) {
                $fields[$mapping["fieldName"]] = [
                    "type" => "integer",
                    "entity_field_name" => $mapping["fieldName"],
                    "joined_entity_fields" => $this->getJoinedEntityFields($metadata_target, $metadata_target->reflClass)
                ];
            }
        }

        foreach ($entity_fields as $entity_field) {
            $fields[$entity_field] = [
                "type" => $metadata->getTypeOfField($entity_field),
                "entity_field_name" => null
            ];
        }
        return $fields;
    }

    /**
     * method to get joined entity fields that are in group ribs_search
     * @param $metadata_target
     * @param $ref_class
     * @return array
     */
    private function getJoinedEntityFields($metadata_target, $ref_class)
    {
        $joined_fields = [];

        foreach ($ref_class->getProperties() as $property) {
            $doc = $property->getDocComment();
            $group_start = strpos($doc, "@Groups(") ? strpos($doc, "@Groups(") + 8 : false;

            if ($group_start) {
                $group_end = strpos($doc, ")", $group_start);
                $groups = substr($doc, $group_start, $group_end - $group_start);

                if (strpos($groups, "ribs_search")) {
                    $joined_fields[$property->getName()] = [
                        "type" => $metadata_target->getTypeOfField($property->getName())
                    ];
                }
            }
        }

        return $joined_fields;
    }
}
