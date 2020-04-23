<?php

namespace PiouPiou\AgriGestionBundle\Entity;;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity\CowsInParcel
 *
 * @ORM\Entity()
 * @ORM\Table(name="ribsmodule_agrigestion_cows_in_parcel", indexes={@ORM\Index(name="fk_parcel_activity_parcel1_idx", columns={"parcel_id"})})
 */
class CowsInParcel
{
    const TYPE = [
        "PENSION" => "Pension",
        "DRY_UP" => "Tarie",
        "MILKING" => "Trayante"
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("main")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("main")
     */
    protected $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("main")
     */
    protected $end_date;

    /**
     * @ORM\Column(type="integer")
     * @Groups("main")
     */
    protected $cow_number;

    /**
     * @ORM\Column(name="`type`", type="string", length=255, nullable=true)
     * @Groups("main")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="Parcel", inversedBy="cowsInParcels")
     * @ORM\JoinColumn(name="parcel_id", referencedColumnName="id", nullable=false)
     * @Groups("main")
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
     * @param string $type
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
     * @return string
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

    /**
     * @return mixed
     * @Groups("main")
     */
    public function getFormattedStartDate()
    {
        return $this->getStartDate()->format("d/m/Y");
    }

    /**
     * @return mixed
     * @Groups("main")
     */
    public function getFormattedEndDate()
    {
        return $this->getEndDate() ? $this->getEndDate()->format("d/m/Y") : null;
    }

    /**
     * @return mixed
     * @Groups("main")
     */
    public function getFormattedType()
    {
        $type = $this->getType() ?? 'MILKING';
        return CowsInParcel::TYPE[$type];
    }
}
