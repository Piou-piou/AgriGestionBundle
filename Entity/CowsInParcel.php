<?php

namespace PiouPiou\AgriGestionBundle\Entity;;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity\CowsInParcel
 *
 * @ORM\Entity()
 * @ORM\Table(name="cows_in_parcel", indexes={@ORM\Index(name="fk_parcel_activity_parcel1_idx", columns={"parcel_id"})})
 */
class CowsInParcel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $end_date;

    /**
     * @ORM\Column(type="integer")
     */
    protected $cow_number;

    /**
     * @ORM\Column(name="`type`", type="smallint", nullable=true)
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Parcel", inversedBy="cowsInParcels")
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
     * @return CowsInParcel
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
     * Set the value of start_date.
     *
     * @param \DateTime $start_date
     * @return CowsInParcel
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of start_date.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set the value of end_date.
     *
     * @param \DateTime $end_date
     * @return CowsInParcel
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of end_date.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set the value of cow_number.
     *
     * @param integer $cow_number
     * @return CowsInParcel
     */
    public function setCowNumber($cow_number)
    {
        $this->cow_number = $cow_number;

        return $this;
    }

    /**
     * Get the value of cow_number.
     *
     * @return integer
     */
    public function getCowNumber()
    {
        return $this->cow_number;
    }

    /**
     * Set the value of type.
     *
     * @param integer $type
     * @return CowsInParcel
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
     * @return CowsInParcel
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
        return array('id', 'start_date', 'end_date', 'cow_number', 'type');
    }
}
