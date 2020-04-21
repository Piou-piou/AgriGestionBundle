<?php

namespace PiouPiou\AgriGestionBundle\Entity;;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity\HayTracking
 *
 * @ORM\Entity()
 * @ORM\Table(name="ribsmodule_agrigestion_hay_tracking", indexes={@ORM\Index(name="fk_hay_tracking_parcel1_idx", columns={"parcel_id"})})
 */
class HayTracking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`year`", type="integer")
     */
    protected $year;

    /**
     * @ORM\Column(type="integer")
     */
    protected $haystack_number;

    /**
     * @ORM\Column(name="`type`", type="smallint")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Parcel", inversedBy="hayTrackings")
     * @ORM\JoinColumn(name="parcel_id", referencedColumnName="id", nullable=false)
     */
    protected $parcel;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return HayTracking
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
     * Set the value of year.
     *
     * @param integer $year
     * @return HayTracking
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of year.
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of haystack_number.
     *
     * @param integer $haystack_number
     * @return HayTracking
     */
    public function setHaystackNumber($haystack_number)
    {
        $this->haystack_number = $haystack_number;

        return $this;
    }

    /**
     * Get the value of haystack_number.
     *
     * @return integer
     */
    public function getHaystackNumber()
    {
        return $this->haystack_number;
    }

    /**
     * Set the value of type.
     *
     * @param integer $type
     * @return HayTracking
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of type.
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set Parcel entity (many to one).
     *
     * @param Parcel $parcel
     * @return HayTracking
     */
    public function setParcel(Parcel $parcel = null)
    {
        $this->parcel = $parcel;

        return $this;
    }

    /**
     * Get Parcel entity (many to one).
     *
     * @return Parcel
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    public function __sleep()
    {
        return array('id', 'year', 'haystack_number', 'type');
    }
}
