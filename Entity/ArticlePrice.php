<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\ArticlePrice
 *
 * @ORM\Table(name="ribsmodule_agrigestion_article_price", indexes={@ORM\Index(name="fk_article_price_article1_idx", columns={"article_id"})})
 */
class ArticlePrice
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
    protected $reference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $quantity_unit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $quantity_packaging;

    /**
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\Column(type="float")
     */
    protected $vat;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $currency;

    /**
     * @ORM\Column(type="integer")
     */
    protected $article_id;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceLine", mappedBy="articlePrice")
     * @ORM\JoinColumn(name="id", referencedColumnName="article_price_id", nullable=false)
     */
    protected $invoiceLines;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="articlePrices")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     */
    protected $article;

    public function __construct()
    {
        $this->invoiceLines = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return ArticlePrice
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
     * Set the value of reference.
     *
     * @param string $reference
     * @return ArticlePrice
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the value of reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set the value of quantity.
     *
     * @param integer $quantity
     * @return ArticlePrice
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of quantity.
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity_unit.
     *
     * @param string $quantity_unit
     * @return ArticlePrice
     */
    public function setQuantityUnit($quantity_unit)
    {
        $this->quantity_unit = $quantity_unit;

        return $this;
    }

    /**
     * Get the value of quantity_unit.
     *
     * @return string
     */
    public function getQuantityUnit()
    {
        return $this->quantity_unit;
    }

    /**
     * Set the value of quantity_packaging.
     *
     * @param integer $quantity_packaging
     * @return ArticlePrice
     */
    public function setQuantityPackaging($quantity_packaging)
    {
        $this->quantity_packaging = $quantity_packaging;

        return $this;
    }

    /**
     * Get the value of quantity_packaging.
     *
     * @return integer
     */
    public function getQuantityPackaging()
    {
        return $this->quantity_packaging;
    }

    /**
     * Set the value of price.
     *
     * @param float $price
     * @return ArticlePrice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of vat.
     *
     * @param float $vat
     * @return ArticlePrice
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
     * Set the value of currency.
     *
     * @param integer $currency
     * @return ArticlePrice
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
     * Set the value of article_id.
     *
     * @param integer $article_id
     * @return ArticlePrice
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;

        return $this;
    }

    /**
     * Get the value of article_id.
     *
     * @return integer
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * Add InvoiceLine entity to collection (one to many).
     *
     * @param InvoiceLine $invoiceLine
     * @return ArticlePrice
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
     * @return ArticlePrice
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
     * Set Article entity (many to one).
     *
     * @param Article $article
     * @return ArticlePrice
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get Article entity (many to one).
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    public function __sleep()
    {
        return array('id', 'reference', 'quantity', 'quantity_unit', 'quantity_packaging', 'price', 'vat', 'currency', 'article_id');
    }
}
