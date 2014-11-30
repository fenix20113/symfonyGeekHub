<?php

namespace Geekhub\GeekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Geekhub\GeekBundle\Entity\CommentRepository")
 * @ORM\Table(name="comments", indexes={
 *  @ORM\Index(name="comment_idx", columns={"id"})
 * })
 */
class Comment
{

    /**
     * @ORM\Id
     * @ORM\Column (type="integer")
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column (type="string", length=255)
     */
    protected $body;

    /**
     *  @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column (type="string", length=255)
     */
    protected $mail;

    /**
     * @ORM\Column (type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;


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
     * Set body
     *
     * @param string $body
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Comment
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
     * Set article
     *
     * @param \Geekhub\GeekBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\Geekhub\GeekBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Geekhub\GeekBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
