<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PiouPiou\AgriGestionBundle\Entity\InvoiceLine
 *
 * @ORM\Entity
 * @ORM\Table(name="ribsmodule_agrigestion_invoice_line", indexes={@ORM\Index(name="fk_invoice_line_article_price1_idx", columns={"article_price_id"}), @ORM\Index(name="fk_invoice_line_invoice1_idx", columns={"invoice_id"})})
 */
class InvoiceLine
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`order`", type="integer", nullable=true)
     */
    protected $order;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $quantity;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $unit_price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $vat;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="integer")
     */
    protected $article_price_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $invoice_id;

    /**
     * @ORM\ManyToOne(targetEntity="ArticlePrice", inversedBy="invoiceLines")
     * @ORM\JoinColumn(name="article_price_id", referencedColumnName="id", nullable=false)
     */
    protected $articlePrice;

    /**
     * @ORM\ManyToOne(targetEntity="Invoice", inversedBy="invoiceLines")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id", nullable=false)
     */
    protected $invoice;

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
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return InvoiceLine
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
     * Set the value of order.
     *
     * @param integer $order
     * @return InvoiceLine
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the value of order.
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of quantity.
     *
     * @param float $quantity
     * @return InvoiceLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of quantity.
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of unit_price.
     *
     * @param float $unit_price
     * @return InvoiceLine
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * Get the value of unit_price.
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set the value of vat.
     *
     * @param float $vat
     * @return InvoiceLine
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
     * Set the value of comment.
     *
     * @param string $comment
     * @return InvoiceLine
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
     * Set the value of article_price_id.
     *
     * @param integer $article_price_id
     * @return InvoiceLine
     */
    public function setArticlePriceId($article_price_id)
    {
        $this->article_price_id = $article_price_id;

        return $this;
    }

    /**
     * Get the value of article_price_id.
     *
     * @return integer
     */
    public function getArticlePriceId()
    {
        return $this->article_price_id;
    }

    /**
     * Set the value of invoice_id.
     *
     * @param integer $invoice_id
     * @return InvoiceLine
     */
    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    /**
     * Get the value of invoice_id.
     *
     * @return integer
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * Set ArticlePrice entity (many to one).
     *
     * @param ArticlePrice $articlePrice
     * @return InvoiceLine
     */
    public function setArticlePrice(ArticlePrice $articlePrice = null)
    {
        $this->articlePrice = $articlePrice;

        return $this;
    }

    /**
     * Get ArticlePrice entity (many to one).
     *
     * @return ArticlePrice
     */
    public function getArticlePrice()
    {
        return $this->articlePrice;
    }

    /**
     * Set Invoice entity (many to one).
     *
     * @param Invoice $invoice
     * @return InvoiceLine
     */
    public function setInvoice(Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get Invoice entity (many to one).
     *
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
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
     * @return InvoiceLine
     */
    public function setCreatedAt($created_at): InvoiceLine
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
     * @return InvoiceLine
     */
    public function setCreatedBy($created_by): InvoiceLine
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
     * @return InvoiceLine
     */
    public function setUpdatedAt($updated_at): InvoiceLine
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
     * @return InvoiceLine
     */
    public function setUpdatedBy($updated_by): InvoiceLine
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'order', 'quantity', 'unit_price', 'vat', 'comment', 'article_price_id', 'invoice_id');
    }
}
