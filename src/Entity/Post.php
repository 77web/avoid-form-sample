<?php


namespace Sample\AvoidForm\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     * @Assert\NotNull
     * @Assert\Type(type="DateTime")
     */
    private $publishedAt;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
}
