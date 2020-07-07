<?php

namespace PiouPiou\AgriGestionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PiouPiou\AgriGestionBundle\Entity\Parcel;

class ParcelRepository extends EntityRepository
{
    /**
     * @return array
     * @throws \Exception
     */
    public function findByOldEndDate()
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p FROM AgriGestionBundle:Parcel p
        ");

        $end_parcels = [];
        $parcels = $query->getResult();

        /** @var Parcel $parcel */
        foreach ($parcels as $parcel) {
            if ($parcel->getCowsInParcels()->count()) {
                foreach ($parcel->getCowsInParcels() as $cows_in_parcel) {
                    if (isset($end_parcels[$parcel->getId()]) && $end_parcels[$parcel->getId()]["end_date"] && (!$cows_in_parcel->getEndDate() || ($cows_in_parcel->getEndDate() < $end_parcels[$parcel->getId()]["end_date"]))) {
                        $end_parcels[$parcel->getId()."-".$parcel->getName()]["end_date"] = $cows_in_parcel->getEndDate();
                    } else {
                        $end_parcels[$parcel->getId()."-".$parcel->getName()] = [
                            "id" => $parcel->getId(),
                            "name" => $parcel->getName(),
                            "surface" => $parcel->getSurface(),
                            "cowsNumber" => $parcel->getCowsNumber(),
                            "end_date" => $cows_in_parcel->getEndDate(),
                            "formattedLastDateWithCows" => $parcel->getFormattedLastDateWithCows(),
                            "number_cows_in_parcel" => $parcel->getCowsInParcels()->count(),
                            "type" => $parcel->getType(),
                            "formatted_type" => $parcel->getFormattedType(),
                            "hay_trackings" => $parcel->getFormattedHaytrackings(),
                        ];
                    }
                }
            } else {
                $end_parcels[$parcel->getId()."-".$parcel->getName()] = [
                    "id" => $parcel->getId(),
                    "name" => $parcel->getName(),
                    "surface" => $parcel->getSurface(),
                    "cowsNumber" => $parcel->getCowsNumber(),
                    "end_date" => null,
                    "formattedLastDateWithCows" => $parcel->getFormattedLastDateWithCows(),
                    "number_cows_in_parcel" => $parcel->getCowsInParcels()->count(),
                    "type" => $parcel->getType(),
                    "formatted_type" => $parcel->getFormattedType(),
                    "hay_trackings" => $parcel->getFormattedHaytrackings(),
                ];
            }
        }

        uasort($end_parcels, function($a, $b) {
            if (!$a["number_cows_in_parcel"]) {
                return 1;
            }
            if (!$a["end_date"] || !$b["end_date"]) {
                return 1;
            }
            if ($a["end_date"] == $b["end_date"]) {
                return 1;
            }
            return ($a["end_date"] < $b["end_date"]) ? -1 : 1;
        });

        return $end_parcels;
    }
}
