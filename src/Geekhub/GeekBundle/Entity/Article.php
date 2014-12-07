<?php

namespace Geekhub\GeekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Geekhub\GeekBundle\Entity\ArticleRepository")
 * @ORM\Table(name="articles", indexes={
 *  @ORM\Index(name="article_idx", columns={"id"})
 * })
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column (type="integer")
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank(message="Title field should be not blank!")
     * @ORM\Column (type="string", length=255)
     */
    protected $title;

    /**
     * @Assert\NotBlank(message="Text field should be not blank!")
     * @ORM\Column (type="text")
     */
    protected $text;


    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column (type="datetime")
     */
    protected $created;


    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;


    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article", cascade={"remove"})
     */
    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Articles
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add comments
     *
     * @param \Geekhub\GeekBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\Geekhub\GeekBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Geekhub\GeekBundle\Entity\Comment $comments
     */
    public function removeComment(\Geekhub\GeekBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
