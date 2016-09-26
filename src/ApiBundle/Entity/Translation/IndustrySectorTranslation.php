<?php

namespace ApiBundle\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="industry_sector_translations", indexes={
 *      @ORM\Index(name="industry_sector_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class IndustrySectorTranslation extends AbstractTranslation {
  /**
   * All required columns are mapped through inherited superclass
   */
}
