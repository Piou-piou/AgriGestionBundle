<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\Provider
 *
 * @ORM\Table(name="provider")
 */
class Provider
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $short_name;

    /**
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $code;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $siren;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $iban;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $created_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $updated_by;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="provider")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_id", nullable=false)
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="provider")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_id", nullable=false)
     */
    protected $invoices;

    /**
     * @ORM\OneToMany(targetEntity="ProviderAdress", mappedBy="provider")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_id", nullable=false)
     */
    protected $providerAdresses;

    /**
     * @ORM\OneToMany(targetEntity="ProviderContact", mappedBy="provider")
     * @ORM\JoinColumn(name="id", referencedColumnName="provider_id", nullable=false)
     */
    protected $providerContacts;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->invoices = new ArrayCollection();
        $this->providerAdresses = new ArrayCollection();
        $this->providerContacts = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return Provider
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
     * Set the value of short_name.
     *
     * @param string $short_name
     * @return Provider
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;

        return $this;
    }

    /**
     * Get the value of short_name.
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return Provider
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
     * Set the value of code.
     *
     * @param string $code
     * @return Provider
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of comment.
     *
     * @param string $comment
     * @return Provider
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
     * Set the value of siret.
     *
     * @param string $siret
     * @return Provider
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get the value of siret.
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set the value of siren.
     *
     * @param string $siren
     * @return Provider
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * Get the value of siren.
     *
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set the value of iban.
     *
     * @param string $iban
     * @return Provider
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get the value of iban.
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set the value of created_at.
     *
     * @param \DateTime $created_at
     * @return Provider
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_by.
     *
     * @param integer $created_by
     * @return Provider
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * Get the value of created_by.
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set the value of updated_at.
     *
     * @param \DateTime $updated_at
     * @return Provider
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of updated_at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_by.
     *
     * @param integer $updated_by
     * @return Provider
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    /**
     * Get the value of updated_by.
     *
     * @return integer
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Add Article entity to collection (one to many).
     *
     * @param Article $article
     * @return Provider
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove Article entity from collection (one to many).
     *
     * @param Article $article
     * @return Provider
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);

        return $this;
    }

    /**
     * Get Article entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add Invoice entity to collection (one to many).
     *
     * @param Invoice $invoice
     * @return Provider
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
     * @return Provider
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
     * Add ProviderAdress entity to collection (one to many).
     *
     * @param ProviderAdress $providerAdress
     * @return Provider
     */
    public function addProviderAdress(ProviderAdress $providerAdress)
    {
        $this->providerAdresses[] = $providerAdress;

        return $this;
    }

    /**
     * Remove ProviderAdress entity from collection (one to many).
     *
     * @param ProviderAdress $providerAdress
     * @return Provider
     */
    public function removeProviderAdress(ProviderAdress $providerAdress)
    {
        $this->providerAdresses->removeElement($providerAdress);

        return $this;
    }

    /**
     * Get ProviderAdress entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProviderAdresses()
    {
        return $this->providerAdresses;
    }

    /**
     * Add ProviderContact entity to collection (one to many).
     *
     * @param ProviderContact $providerContact
     * @return Provider
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
     * @return Provider
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

    public function __sleep()
    {
        return array('id', 'short_name', 'name', 'code', 'comment', 'siret', 'siren', 'iban', 'created_at', 'created_by', 'updated_at', 'updated_by');
    }
}
