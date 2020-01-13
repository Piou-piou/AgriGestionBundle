<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\ProviderContact
 *
 * @ORM\Entity
 * @ORM\Table(name="ribsmodule_agrigestion_provider_contact", indexes={@ORM\Index(name="fk_provider_contact_provider_adress1_idx", columns={"provider_adress_id"}), @ORM\Index(name="fk_provider_contact_provider1_idx", columns={"provider_id"})})
 */
class ProviderContact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(name="`role`", type="smallint", nullable=true)
     */
    protected $role;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $phone_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_adress_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_id;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="providerContact")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_contact_id", nullable=false)
     */
    protected $invoices;

    /**
     * @ORM\ManyToOne(targetEntity="ProviderAdress", inversedBy="providerContacts")
     * @ORM\JoinColumn(name="provider_adress_id", referencedColumnName="id", nullable=false)
     */
    protected $providerAdress;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="providerContacts")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     */
    protected $provider;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="PiouPiou\RibsAdminBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", nullable=false)
     */
    protected $created_by;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="PiouPiou\RibsAdminBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id", nullable=false)
     */
    protected $updated_by;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return ProviderContact
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
     * Set the value of first_name.
     *
     * @param string $first_name
     * @return ProviderContact
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of first_name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of last_name.
     *
     * @param string $last_name
     * @return ProviderContact
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of last_name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of gender.
     *
     * @param integer $gender
     * @return ProviderContact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of gender.
     *
     * @return integer
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     * @return ProviderContact
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of role.
     *
     * @param integer $role
     * @return ProviderContact
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of role.
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of phone_number.
     *
     * @param integer $phone_number
     * @return ProviderContact
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get the value of phone_number.
     *
     * @return integer
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of mobile.
     *
     * @param integer $mobile
     * @return ProviderContact
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the value of mobile.
     *
     * @return integer
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of comment.
     *
     * @param string $comment
     * @return ProviderContact
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of provider_adress_id.
     *
     * @param integer $provider_adress_id
     * @return ProviderContact
     */
    public function setProviderAdressId($provider_adress_id)
    {
        $this->provider_adress_id = $provider_adress_id;

        return $this;
    }

    /**
     * Get the value of provider_adress_id.
     *
     * @return integer
     */
    public function getProviderAdressId()
    {
        return $this->provider_adress_id;
    }

    /**
     * Set the value of provider_id.
     *
     * @param integer $provider_id
     * @return ProviderContact
     */
    public function setProviderId($provider_id)
    {
        $this->provider_id = $provider_id;

        return $this;
    }

    /**
     * Get the value of provider_id.
     *
     * @return integer
     */
    public function getProviderId()
    {
        return $this->provider_id;
    }

    /**
     * Add Invoice entity to collection (one to many).
     *
     * @param Invoice $invoice
     * @return ProviderContact
     */
    public function addInvoice(Invoice $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove Invoice entity from collection (one to many).
     *
     * @param Invoice $invoice
     * @return ProviderContact
     */
    public function removeInvoice(Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);

        return $this;
    }

    /**
     * Get Invoice entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * Set ProviderAdress entity (many to one).
     *
     * @param ProviderAdress $providerAdress
     * @return ProviderContact
     */
    public function setProviderAdress(ProviderAdress $providerAdress = null)
    {
        $this->providerAdress = $providerAdress;

        return $this;
    }

    /**
     * Get ProviderAdress entity (many to one).
     *
     * @return ProviderAdress
     */
    public function getProviderAdress()
    {
        return $this->providerAdress;
    }

    /**
     * Set Provider entity (many to one).
     *
     * @param Provider $provider
     * @return ProviderContact
     */
    public function setProvider(Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get Provider entity (many to one).
     *
     * @return Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return ProviderContact
     */
    public function setCreatedAt($created_at): ProviderContact
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @ORM\PrePersist
     * @param mixed $created_by
     * @return ProviderContact
     */
    public function setCreatedBy($created_by): ProviderContact
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return ProviderContact
     */
    public function setUpdatedAt($updated_at): ProviderContact
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @ORM\PreUpdate
     * @param mixed $updated_by
     * @return ProviderContact
     */
    public function setUpdatedBy($updated_by): ProviderContact
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'first_name', 'last_name', 'gender', 'title', 'role', 'phone_number', 'mobile', 'comment', 'provider_adress_id', 'provider_id');
    }
}
