<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotCle
 *
 * @ORM\Table(name="mot_cle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MotCleRepository")
 */
class MotCle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=255)
     */
    private $word;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Url", inversedBy="motsCles", cascade={"persist"})
     * @ORM\JoinColumn(name="url_id", referencedColumnName="id")
     */
    private $url;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     *
     * @return MotCle
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set url
     *
     * @param \AppBundle\Entity\Url $url
     *
     * @return MotCle
     */
    public function setUrl(\AppBundle\Entity\Url $url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return \AppBundle\Entity\Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function __toString(){
        return $this->word;
    }
}
