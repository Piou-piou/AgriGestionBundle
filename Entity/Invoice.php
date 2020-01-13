<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\Invoice
 *
 * @ORM\Entity
 * @ORM\Table(name="ribsmodule_agrigestion_invoice", indexes={@ORM\Index(name="fk_invoice_provider_contact1_idx", columns={"provider_contact_id"}), @ORM\Index(name="fk_invoice_provider_adress1_idx", columns={"provider_adress_id"}), @ORM\Index(name="fk_invoice_provider1_idx", columns={"provider_id"})})
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`number`", type="string", length=255)
     */
    protected $number;

    /**
     * @ORM\Column(name="`date`", type="date", nullable=true)
     */
    protected $date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $payment_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $due_date;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $payment_method;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $currency;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $vat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $amount;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_contact_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_adress_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_id;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceLine", mappedBy="invoice")
     * @ORM\JoinColumn(name="id", referencedColumnName="invoice_id", nullable=false)
     */
    protected $invoiceLines;

    /**
     * @ORM\ManyToOne(targetEntity="ProviderContact", inversedBy="invoices")
     * @ORM\JoinColumn(name="provider_contact_id", referencedColumnName="id", nullable=false)
     */
    protected $providerContact;

    /**
     * @ORM\ManyToOne(targetEntity="ProviderAdress", inversedBy="invoices")
     * @ORM\JoinColumn(name="provider_adress_id", referencedColumnName="id", nullable=false)
     */
    protected $providerAdress;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="invoices")
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
        $this->invoiceLines = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return Invoice
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
     * Set the value of number.
     *
     * @param string $number
     * @return Invoice
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of date.
     *
     * @param \DateTime $date
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of payment_date.
     *
     * @param \DateTime $payment_date
     * @return Invoice
     */
    public function setPaymentDate($payment_date)
    {
        $this->payment_date = $payment_date;

        return $this;
    }

    /**
     * Get the value of payment_date.
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    /**
     * Set the value of due_date.
     *
     * @param \DateTime $due_date
     * @return Invoice
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;

        return $this;
    }

    /**
     * Get the value of due_date.
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * Set the value of payment_method.
     *
     * @param integer $payment_method
     * @return Invoice
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * Get the value of payment_method.
     *
     * @return integer
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Set the value of currency.
     *
     * @param integer $currency
     * @return Invoice
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get the value of currency.
     *
     * @return integer
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of vat.
     *
     * @param float $vat
     * @return Invoice
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get the value of vat.
     *
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set the value of amount.
     *
     * @param float $amount
     * @return Invoice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of amount.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of comment.
     *
     * @param string $comment
     * @return Invoice
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
     * Set the value of provider_contact_id.
     *
     * @param integer $provider_contact_id
     * @return Invoice
     */
    public function setProviderContactId($provider_contact_id)
    {
        $this->provider_contact_id = $provider_contact_id;

        return $this;
    }

    /**
     * Get the value of provider_contact_id.
     *
     * @return integer
     */
    public function getProviderContactId()
    {
        return $this->provider_contact_id;
    }

    /**
     * Set the value of provider_adress_id.
     *
     * @param integer $provider_adress_id
     * @return Invoice
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
     * @return Invoice
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
     * Add InvoiceLine entity to collection (one to many).
     *
     * @param InvoiceLine $invoiceLine
     * @return Invoice
     */
    public function addInvoiceLine(InvoiceLine $invoiceLine)
    {
        $this->invoiceLines[] = $invoiceLine;

        return $this;
    }

    /**
     * Remove InvoiceLine entity from collection (one to many).
     *
     * @param InvoiceLine $invoiceLine
     * @return Invoice
     */
    public function removeInvoiceLine(InvoiceLine $invoiceLine)
    {
        $this->invoiceLines->removeElement($invoiceLine);

        return $this;
    }

    /**
     * Get InvoiceLine entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    /**
     * Set ProviderContact entity (many to one).
     *
     * @param ProviderContact $providerContact
     * @return Invoice
     */
    public function setProviderContact(ProviderContact $providerContact = null)
    {
        $this->providerContact = $providerContact;

        return $this;
    }

    /**
     * Get ProviderContact entity (many to one).
     *
     * @return ProviderContact
     */
    public function getProviderContact()
    {
        return $this->providerContact;
    }

    /**
     * Set ProviderAdress entity (many to one).
     *
     * @param ProviderAdress $providerAdress
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
     */
    public function setCreatedAt($created_at): Invoice
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
     * @return Invoice
     */
    public function setCreatedBy($created_by): Invoice
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
     * @return Invoice
     */
    public function setUpdatedAt($updated_at): Invoice
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
     * @return Invoice
     */
    public function setUpdatedBy($updated_by): Invoice
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'number', 'date', 'payment_date', 'due_date', 'payment_method', 'currency', 'vat', 'amount', 'comment', 'provider_contact_id', 'provider_adress_id', 'provider_id');
    }
}
