<?php

namespace PiouPiou\AgriGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PiouPiou\AgriGestionBundle\Entity\Article
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="article", indexes={@ORM\Index(name="fk_article_provider1_idx", columns={"provider_id"})})
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @ORM\PrePersist
     * @ORM\ManyToOne(targetEntity="PiouPiou\RibsAdminBundle\Entity\User", inversedBy="createdByArticles")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", nullable=false)
     */
    protected $created_by;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @ORM\PreUpdate
     * @ORM\ManyToOne(targetEntity="PiouPiou\RibsAdminBundle\Entity\User", inversedBy="updatedByArticles")
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

    public function __sleep()
    {
        return array('id', 'reference', 'name', 'comment', 'provider_id');
    }
}
