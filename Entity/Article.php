<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PiouPiou\AgriGestionBundle\Entity\Article
 *
 * @ORM\Entity()
 * @ORM\Table(name="ribsmodule_agrigestion_article", indexes={@ORM\Index(name="fk_article_provider1_idx", columns={"provider_id"})})
 * @ORM\EntityListeners({"PiouPiou\AgriGestionBundle\EventListener\CreateUpdateAwareListener"})
 */
class Article
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
     * @ORM\Column(name="`name`", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="integer")
     */
    protected $provider_id;

    /**
     * @ORM\OneToMany(targetEntity="ArticlePrice", mappedBy="article")
     * @ORM\JoinColumn(name="id", referencedColumnName="article_id", nullable=false)
     */
    protected $articlePrices;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="articles")
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
        $this->articlePrices = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return Article
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
     * @return Article
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
     * Set the value of name.
     *
     * @param string $name
     * @return Article
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
     * Set the value of comment.
     *
     * @param string $comment
     * @return Article
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
     * Set the value of provider_id.
     *
     * @param integer $provider_id
     * @return Article
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
     * Add ArticlePrice entity to collection (one to many).
     *
     * @param ArticlePrice $articlePrice
     * @return Article
     */
    public function addArticlePrice(ArticlePrice $articlePrice)
    {
        $this->articlePrices[] = $articlePrice;

        return $this;
    }

    /**
     * Remove ArticlePrice entity from collection (one to many).
     *
     * @param ArticlePrice $articlePrice
     * @return Article
     */
    public function removeArticlePrice(ArticlePrice $articlePrice)
    {
        $this->articlePrices->removeElement($articlePrice);

        return $this;
    }

    /**
     * Get ArticlePrice entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticlePrices()
    {
        return $this->articlePrices;
    }

    /**
     * Set Provider entity (many to one).
     *
     * @param Provider $provider
     * @return Article
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
     * @return Article
     */
    public function setCreatedAt($created_at): Article
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
     * @return Article
     */
    public function setCreatedBy($created_by): Article
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
     * @return Article
     */
    public function setUpdatedAt($updated_at): Article
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
     * @return Article
     */
    public function setUpdatedBy($updated_by): Article
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'reference', 'name', 'comment', 'provider_id');
    }
}
