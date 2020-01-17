<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\ProviderAdress
 *
 * @ORM\Entity
 * @ORM\Table(name="ribsmodule_agrigestion_provider_adress", indexes={@ORM\Index(name="fk_provider_adress_provider_idx", columns={"provider_id"})})
 * @ORM\EntityListeners({"PiouPiou\AgriGestionBundle\EventListener\CreateUpdateAwareListener"})
 */
class ProviderAddress
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(name="`state`", type="string", length=255, nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_id;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="providerAdress")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_adress_id", nullable=false)
     */
    protected $invoices;

    /**
     * @ORM\OneToMany(targetEntity="ProviderContact", mappedBy="providerAddress")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_adress_id", nullable=false)
     */
    protected $providerContacts;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="providerAdresses")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", nullable=false)
     */
    protected $provider;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="PiouPiou\RibsAdminBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", nullable=false)
     */
    protected $created_by;

    /**
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
        $this->providerContacts = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return ProviderAddress
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
     * @return ProviderAddress
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
     * Set the value of address.
     *
     * @param string $address
     * @return ProviderAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address1.
     *
     * @param string $address1
     * @return ProviderAddress
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get the value of address1.
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set the value of postal_code.
     *
     * @param string $postal_code
     * @return ProviderAddress
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Get the value of postal_code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set the value of city.
     *
     * @param string $city
     * @return ProviderAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of state.
     *
     * @param string $state
     * @return ProviderAddress
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of country.
     *
     * @param string $country
     * @return ProviderAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of provider_id.
     *
     * @param integer $provider_id
     * @return ProviderAddress
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
     * @return ProviderAddress
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
     * @return ProviderAddress
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
     * Add ProviderContact entity to collection (one to many).
     *
     * @param ProviderContact $providerContact
     * @return ProviderAddress
     */
    public function addProviderContact(ProviderContact $providerContact)
    {
        $this->providerContacts[] = $providerContact;

        return $this;
    }

    /**
     * Remove ProviderContact entity from collection (one to many).
     *
     * @param ProviderContact $providerContact
     * @return ProviderAddress
     */
    public function removeProviderContact(ProviderContact $providerContact)
    {
        $this->providerContacts->removeElement($providerContact);

        return $this;
    }

    /**
     * Get ProviderContact entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProviderContacts()
    {
        return $this->providerContacts;
    }

    /**
     * Set Provider entity (many to one).
     *
     * @param Provider $provider
     * @return ProviderAddress
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
     * @return ProviderAddress
     */
    public function setCreatedAt($created_at): ProviderAddress
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
     * @param mixed $created_by
     * @return ProviderAddress
     */
    public function setCreatedBy($created_by): ProviderAddress
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
     * @return ProviderAddress
     */
    public function setUpdatedAt($updated_at): ProviderAddress
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
     * @param mixed $updated_by
     * @return ProviderAddress
     */
    public function setUpdatedBy($updated_by): ProviderAddress
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'name', 'address', 'address1', 'postal_code', 'city', 'state', 'country', 'provider_id');
    }
}
