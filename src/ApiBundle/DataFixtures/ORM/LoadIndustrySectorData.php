<?php

namespace ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ApiBundle\Entity\IndustrySector;

class LoadIndustrySectorData implements FixtureInterface {

  public function load(ObjectManager $manager) {
    $listSectors = array(
      array('internal' => 'aerospace', 'fr' => 'Aérospatial', 'en' => 'Aerospace'),
      array('internal' => 'aeronautics', 'fr' => 'Aéronautique', 'en' => 'Aeronautics'),
      array('internal' => 'agriculture', 'fr' => 'Agriculture', 'en' => 'Agriculture'),
      array('internal' => 'food_products', 'fr' => 'Agroalimentaire', 'en' => 'Food Products'),
      array('internal' => 'mobile_app', 'fr' => 'Applis mobiles', 'en' => 'Mobile applications'),
      array('internal' => 'arts', 'fr' => 'Arts', 'en' => 'Arts'),
      array('internal' => 'associative', 'fr' => 'Associatif - Caritatif', 'en' => 'Associative - Charity'),
      array('internal' => 'automobile', 'fr' => 'Automobile - Moto', 'en' => 'Automobile - Motorbike'),
      array('internal' => 'banking', 'fr' => 'Banque - Assurance', 'en' => 'Banking - Insurance'),
      array('internal' => 'healthcare', 'fr' => 'Beauté - santé', 'en' => 'Beauty - Healthcare'),
      array('internal' => 'biotechnology', 'fr' => 'Biotechnologie - Pharmaceutique', 'en' => 'Biotechnology - Pharmaceutical'),
      array('internal' => 'chemicals', 'fr' => 'Chimie', 'en' => 'Chemicals'),
      array('internal' => 'local_commerce', 'fr' => 'Commerce de proximité', 'en' => 'Local commerce'),
      array('internal' => 'communication', 'fr' => 'Communication', 'en' => 'Communication'),
      array('internal' => 'accounting', 'fr' => 'Comptabilité', 'en' => 'Accounting'),
      array('internal' => 'consulting', 'fr' => 'Conseil - coaching', 'en' => 'Consulting - coaching'),
      array('internal' => 'building', 'fr' => 'Construction - Bâtiment', 'en' => 'Building - Construction'),
      array('internal' => 'ship_building', 'fr' => 'Constuction de bateaux', 'en' => 'Ships construction'),
      array('internal' => 'distribution', 'fr' => 'Distribution - Import Export', 'en' => 'Distribution - Import Export'),
      array('internal' => 'entertainment', 'fr' => 'Divertissement', 'en' => 'Entertainment'),
      array('internal' => 'law', 'fr' => 'Droit', 'en' => 'Law'),
      array('internal' => 'collaborative_economy', 'fr' => 'Economie collaborative', 'en' => 'Collaborative Economy'),
      array('internal' => 'publishing', 'fr' => 'Edition - Journalisme', 'en' => 'Publishing - Journalism'),
      array('internal' => 'software_edition', 'fr' => 'Edition de logiciel', 'en' => 'Software Edition'),
      array('internal' => 'electronics', 'fr' => 'Electronique', 'en' => 'Electronics'),
      array('internal' => 'energy', 'fr' => 'Energie -Industrie pétrolière', 'en' => 'Energy - oil industry'),
      array('internal' => 'teaching', 'fr' => 'Enseignement', 'en' => 'Teaching'),
      array('internal' => 'social_enterprise', 'fr' => 'Entreprise sociale et solidaire', 'en' => 'Social solidarity enterprise'),
      array('internal' => 'audio_visual', 'fr' => 'Audiovisuel', 'en' => 'Audio-visual'),
      array('internal' => 'financial', 'fr' => 'Finance', 'en' => 'Financial'),
      array('internal' => 'hotel_restaurant', 'fr' => 'Hôtellerie - Restauration', 'en' => 'Hotel and restaurant'),
      array('internal' => 'real_estate', 'fr' => 'Immobilier', 'en' => 'Real Estate Development'),
      array('internal' => 'green_industry', 'fr' => 'Industrie verte', 'en' => 'Green industry'),
      array('internal' => 'engeeniring', 'fr' => 'Ingénierie', 'en' => 'Engeeniring'),
      array('internal' => 'e_commerce', 'fr' => 'Internet - e-commerce', 'en' => 'E-commerce industry'),
      array('internal' => 'blogging', 'fr' => 'Internet - information & blogging', 'en' => 'Internet blogging'),
      array('internal' => 'social_networks', 'fr' => 'Internet - réseaux sociaux', 'en' => 'Social networks'),
      array('internal' => 'online_service', 'fr' => 'Internet - services en ligne', 'en' => 'Online Services'),
      array('internal' => 'luxury', 'fr' => 'Luxe et Mode', 'en' => 'Luxury and mode'),
      array('internal' => 'retail', 'fr' => 'Magasin de détail', 'en' => 'Retail store'),
      array('internal' => 'marketing', 'fr' => 'Marketing', 'en' => 'Marketing'),
      array('internal' => 'internet_of_things', 'fr' => 'Objets connectés', 'en' => 'Internet of things'),
      array('internal' => 'industrial_production', 'fr' => 'Production industrielle', 'en' => 'Industrial production'),
      array('internal' => 'human_resources', 'fr' => 'Recrutement - Ressources humaines', 'en' => 'Recruitment - Human Resources'),
      array('internal' => 'personal_service', 'fr' => 'Services à la personne', 'en' => 'Personal Services'),
      array('internal' => 'company_service', 'fr' => 'Services aux entreprise', 'en' => 'Company Services'),
      array('internal' => 'security', 'fr' => 'Sécurité', 'en' => 'Security'),
      array('internal' => 'sport', 'fr' => 'Sport', 'en' => 'Sporting activities'),
      array('internal' => 'telecom', 'fr' => 'Télécommunication', 'en' => 'Telecom services'),
      array('internal' => 'leasing_service', 'fr' => 'Tourisme - loisirs', 'en' => 'Leasing Services'),
      array('internal' => 'shipping', 'fr' => 'Transport et logistique', 'en' => 'Trucking and shipping'),
      array('internal' => 'textile', 'fr' => 'Vêtements et accessoires', 'en' => 'Textile and accessories'),
      array('internal' => 'other', 'fr' => 'Autre', 'en' => 'Other'),
    );

    foreach($listSectors as $sector) {
      $entitySector = new IndustrySector();
      //$entitySector->setTranslatableLocale('fr_fr');
      $entitySector->setInternalName($sector['internal']);
      $entitySector->setName($sector['fr']);

      // persisting multiple translations, assume default locale is EN
      $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
      $repository->translate($entitySector, 'name', 'en_uk', $sector['en']);

      $manager->persist($entitySector);
      $manager->flush();
    }
  }
}
