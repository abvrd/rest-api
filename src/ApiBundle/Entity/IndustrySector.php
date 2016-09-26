<?php

namespace ApiBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Table(name="industry_sector")
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\IndustrySectorRepository")
 * @Gedmo\TranslationEntity(class="ApiBundle\Entity\Translation\IndustrySectorTranslation")
 *
 * @ExclusionPolicy("all")
 */
class IndustrySector implements Translatable {

    /**
     * Primary key
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * Code name of the sector for internal use
     * @var string
     *
     * @ORM\Column(name="internal_name", type="string", length=128)
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Expose
     */
    private $internalName;

    /**
     * Name of the sector for general use and display
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=128)
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Expose
     */
    private $name;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    public function setTranslatableLocale($locale){
      $this->locale = $locale;
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
     * Set internalName
     *
     * @param string $internalName
     *
     * @return IndustrySector
     */
    public function setInternalName($internalName)
    {
        $this->internalName = $internalName;

        return $this;
    }

    /**
     * Get internalName
     *
     * @return string
     */
    public function getInternalName()
    {
        return $this->internalName;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return IndustrySector
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
