<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity\Parcel
 *
 * @ORM\Entity(repositoryClass="PiouPiou\AgriGestionBundle\Repository\ParcelRepository")
 * @ORM\Table(name="ribsmodule_agrigestion_parcel")
 */
class Parcel
{
    const TYPES = [
        "HAY" => "Foins",
        "COWS" => "Vaches",
        "BOTH" => "Les deux",
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("main")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=255)
     * @Groups("main")
     */
    protected $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("main")
     */
    protected $surface;

    /**
     * @ORM\Column(name="`type`", type="string", length=255, nullable=true)
     * @Groups("main")
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="CowsInParcel", mappedBy="parcel")
     * @ORM\JoinColumn(name="id", referencedColumnName="parcel_id", nullable=false)
     */
    protected $cowsInParcels;

    /**
     * @ORM\OneToMany(targetEntity="HayTracking", mappedBy="parcel")
     * @ORM\JoinColumn(name="id", referencedColumnName="parcel_id", nullable=false)
     */
    protected $hayTrackings;

    public function __construct()
    {
        $this->cowsInParcels = new ArrayCollection();
        $this->hayTrackings = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return Parcel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return Parcel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of surface.
     *
     * @param float $surface
     * @return Parcel
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get the value of surface.
     *
     * @return float
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Parcel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Add CowsInParcel entity to collection (one to many).
     *
     * @param CowsInParcel $cowsInParcel
     * @return Parcel
     */
    public function addCowsInParcel(CowsInParcel $cowsInParcel)
    {
        $this->cowsInParcels[] = $cowsInParcel;

        return $this;
    }

    /**
     * Remove CowsInParcel entity from collection (one to many).
     *
     * @param CowsInParcel $cowsInParcel
     * @return Parcel
     */
    public function removeCowsInParcel(CowsInParcel $cowsInParcel)
    {
        $this->cowsInParcels->removeElement($cowsInParcel);

        return $this;
    }

    /**
     * Get CowsInParcel entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCowsInParcels()
    {
        return $this->cowsInParcels;
    }

    /**
     * Add HayTracking entity to collection (one to many).
     *
     * @param HayTracking $hayTracking
     * @return Parcel
     */
    public function addHayTracking(HayTracking $hayTracking)
    {
        $this->hayTrackings[] = $hayTracking;

        return $this;
    }

    /**
     * Remove HayTracking entity from collection (one to many).
     *
     * @param HayTracking $hayTracking
     * @return Parcel
     */
    public function removeHayTracking(HayTracking $hayTracking)
    {
        $this->hayTrackings->removeElement($hayTracking);

        return $this;
    }

    /**
     * Get HayTracking entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHayTrackings()
    {
        return $this->hayTrackings;
    }

    public function __sleep()
    {
        return array('id', 'name', 'surface');
    }

    /**
     * @return ArrayCollection
     * @throws Exception
     */
    public function getLastDateWithCows()
    {
        $last_date = null;
        foreach ($this->getCowsInParcels() as $cowsInParcel) {
            if ($cowsInParcel->getEndDate() && (!$last_date || $last_date < $cowsInParcel->getEndDate())) {
                $last_date = $cowsInParcel->getEndDate();
            }
            if (!$cowsInParcel->getEndDate()) {
                $last_date = null;
            }
        }
        return $last_date;
    }

    /**
     * @Groups("main")
     * @return mixed
     * @throws Exception
     */
    public function getFormattedLastDateWithCows()
    {
        return $this->getLastDateWithCows() ? $this->getLastDateWithCows()->format("d/m/Y") : null;
    }

    /**
     * @Groups("main")
     * @return int
     */
    public function getCowsNumber()
    {
        return $this->getCowsInParcels() && $this->getCowsInParcels()->count() ? $this->getCowsInParcels()->first()->getCowNumber() : 0;
    }

    public function getFormattedHaytrackings()
    {
        $haytrackings = [];
        /** @var HayTracking $haytracking */
        foreach ($this->getHayTrackings() as $haytracking) {
            $haytrackings[] = $haytracking->getYear() . " : " . $haytracking->gethaystackNumber() . " bottes de " . $haytracking->getFormattedType();
        }
        return $haytrackings;
    }

    public static function retrieveTypeLabels(): array
    {
        $types = [];

        foreach (self::TYPES as $key => $value) {
            $types[$value] = $key;
        }

        return $types;
    }

    public function getFormattedType()
    {
        if ($this->getType()) {
            return self::TYPES[$this->getType()];
        }

        return self::TYPES['BOTH'];
    }
}
