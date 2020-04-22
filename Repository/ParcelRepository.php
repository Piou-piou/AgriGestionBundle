<?php

namespace PiouPiou\AgriGestionBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParcelRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function findByOldEndDate()
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p, CASE WHEN cip.end_date IS NULL THEN 0 ELSE 1 END AS HIDDEN end_date_null FROM AgriGestionBundle:Parcel p
            JOIN AgriGestionBundle:CowsInParcel cip WITH cip.parcel = p
            ORDER BY end_date_null DESC, cip.end_date ASC
        ");

        return $query->getResult();
    }
}
