<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Perimeters
 *
 * @ORM\Table(name="perimeters")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Perimeters
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label_fr", type="string", length=255, nullable=false)
     */
    protected $labelFr;

    /**
     * @var string
     *
     * @ORM\Column(name="label_en", type="string", length=255, nullable=false)
     */
    protected $labelEn;

    /**
     * @var Perimeters
     *
     * @ORM\ManyToOne(targetEntity="Perimeters", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="perimeter_id", referencedColumnName="id", nullable=true)
     * })
     */
    protected $perimeter;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Perimeters", mappedBy="perimeter")
     */
    protected $children;

    private $indentedName;

    /**
     * Perimeters constructor.
     * @param $children
     */
    public function __construct($children = null)
    {
        $this->children = $children;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Perimeters
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabelFr()
    {
        return $this->labelFr;
    }

    /**
     * @param string $labelFr
     * @return Perimeters
     */
    public function setLabelFr(string $labelFr)
    {
        $this->labelFr = $labelFr;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabelEn()
    {
        return $this->labelEn;
    }

    /**
     * @param string $labelEn
     * @return Perimeters
     */
    public function setLabelEn(string $labelEn)
    {
        $this->labelEn = $labelEn;

        return $this;
    }

    /**
     * @return Perimeters
     */
    public function getPerimeter()
    {
        return $this->perimeter;
    }

    /**
     * @param Perimeters $perimeter
     * @return Perimeters
     */
    public function setPerimeter(Perimeters $perimeter)
    {
        $this->perimeter = $perimeter;

        return $this;
    }

    /**
     * @return null|Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     * @return Perimeters
     */
    public function setChildren(Collection $children)
    {
        $this->children = $children;
        return $this;
    }

    public function __toString()
    {
        return $this->getLabelFr();
    }

    public function getIndentedName() {
        return str_repeat($this->perimeter." > ", 2) . $this->labelFr;
    }
}




