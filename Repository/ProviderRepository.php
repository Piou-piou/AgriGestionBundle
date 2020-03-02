<?php

namespace PiouPiou\AgriGestionBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProviderRepository extends EntityRepository
{
    public function autocomplete(string $search)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p FROM AgriGestionBundle:Provider p WHERE
            p.short_name LIKE :search OR
            p.name LIKE :search OR
            p.code LIKE :search OR
            p.siret LIKE :search OR
            p.siren LIKE :search OR
            p.iban LIKE :search
            ORDER BY p.name, p.short_name
        ");
        $query->setParameter("search", $search."%", \PDO::PARAM_STR);

        return $query->getResult();
    }
}
