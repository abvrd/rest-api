<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use ApiBundle\Entity\IndustrySector;
use ApiBundle\Form\Type\IndustrySectorType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndustrySectorController extends FOSRestController {
  private $em;

  /**
   * @ApiDoc(
   *  resource=true,
   *  description="Return a list of all Industry sectors",
   *  statusCodes = {
   *     200 = "Returned when successful",
   *     404 = "Returned when sectors are not found"
   *   }
   * )
   * @return IndustrySector[]
   */
  public function getSectorsAction() {
    // get list of sectors ordered by name
    $listSectors = $this->getEntityManager()->getRepository('ApiBundle:IndustrySector')->findAllOrderedByName();

    return $listSectors;
  }

  /**
   * @ApiDoc(
   *  resource=true,
   *  description="Return an industry sector",
   *  output = "ApiBundle\Entity\IndustrySector",
   *  statusCodes = {
   *     200 = "Returned when successful",
   *     404 = "Returned when the sector is not found"
   *   }
   * )
   * @param integer $id the identificator of the sector
   * @return IndustrySector
   *
   */
  public function getSectorAction($id) {
    $sector = $this->getEntityManager()->getRepository('ApiBundle:IndustrySector')->find($id);

    if(is_null($sector)) {
      return new View($sector, Response::HTTP_NOT_FOUND);
    }

    return $sector;
  }

  /**
   * @ApiDoc(
   *   resource = true,
   *   description = "Creates a new sector from the submitted data.",
   *   responseMap = {
   *   	201 = {
   *    		"class" = "ApiBundle\Entity\IndustrySector"
   *      }
   *   },
   *   statusCodes = {
   *     201 = "Returned when successful",
   *     422 = "Returned when the sector has errors"
   *   }
   * )
   *
   * @param ParamFetcher $paramFetcher the request object
   *
   * @RequestParam(name="internal_name", nullable=false, requirements="string", description="Internal Name of the sector.")
   * @RequestParam(name="name", nullable=false, requirements="string", description="Name of the sector in the current locale.")
   *
   * @return View
   */
  public function postSectorsAction(ParamFetcher $paramFetcher) {

    $sector = new IndustrySector();

    // validating the object set
    $errors = $this->processAndValidateRequest($sector, $paramFetcher);

    if (count($errors) > 0) {
      // 422 validation error code
      return new View(
        $errors,
        Response::HTTP_UNPROCESSABLE_ENTITY
      );
    }

    // persisting the sector
    $manager = $this->getEntityManager();
    $manager->persist($sector);
    $manager->flush();

    // created code 201
    return new View($sector, Response::HTTP_CREATED);
  }

  /**
   * Update a Sector
   * @ApiDoc(
   *   resource = true,
   *   description = "Update a task from the submitted data by ID.",
   *   responseMap = {
   *   	200 = {
   *    		"class" = "ApiBundle\Entity\IndustrySector"
   *      }
   *   },
   *   statusCodes = {
   *     200 = "Returned when successful",
   *     422 = "Returned when the sector has errors"
   *   }
   * )
   *
   * @param int $id the identificator of the sector
   * @param ParamFetcher $paramFetcher the request object
   *
   * @RequestParam(name="internal_name", nullable=false, requirements="string", description="Internal Name of the sector.")
   * @RequestParam(name="name", nullable=false, requirements="string", description="Name of the sector in the current locale.")
   *
   * @return View
   */
  public function putSectorAction($id, ParamFetcher $paramFetcher) {
    $idSector = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    // retrieving the object
    $sector = $this->getEntityManager()->getRepository('ApiBundle:IndustrySector')->find($idSector);

    // validating the object set
    $errors = $this->processAndValidateRequest($sector, $paramFetcher);

    if (count($errors) > 0) {
      // 422 validation error code
      return new View(
        $errors,
        Response::HTTP_UNPROCESSABLE_ENTITY
      );
    }

    // update object
    $manager = $this->getEntityManager();
    $manager->merge($sector);
    $manager->flush();

    return new View($sector, Response::HTTP_OK);
  }

  /**
   * Delete an sector identified by id.
   * @ApiDoc(
   *   resource = true,
   *   description = "Delete a sector identified by its id",
   *   statusCodes = {
   *     204 = "Returned when successful",
   *     404 = "Returned when the sector is not found"
   *   }
   * )
   * @param  int $id the identificator of the sector
   * @return View    the response
   */
  public function deleteTaskAction($id) {
    $idSector = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    // retrieving the object
    $sector = $this->getEntityManager()->getRepository('ApiBundle:IndustrySector')->find($idSector);

    if (!$sector) {
      return new View(
        'No product found for the id ' . $id,
        Response::HTTP_NOT_FOUND
      );
    }

    // update object
    $manager = $this->getEntityManager();
    $manager->removeremove($sector);
    $manager->flush();

    return new View($sector, Response::HTTP_NO_CONTENT);
  }

  /**
   * Fill $sector with the parameters send in request and validates it
   * @param  IndustrySector $sector       the sector to fill and validate
   * @param  ParamFetcher   $paramFetcher the request object
   * @return array                        returns array of errors (empty if everything is ok)
   */
  public function processAndValidateRequest(IndustrySector &$sector, ParamFetcher $paramFetcher) {
    if (!$sector) {
      return array('No product found.');
    }
    $name = filter_var($paramFetcher->get('name'), FILTER_SANITIZE_STRING);
    $internalName = filter_var($paramFetcher->get('internal_name'), FILTER_SANITIZE_STRING);

    $sector->setName($name);
    $sector->setInternalName($internalName);

    $errors = $this->get('validator')->validate($sector);
    return $errors;
  }

  /**
   * Get the entity manager
   */
  public function getEntityManager() {
    if($this->em === null) {
      $this->em = $this->getDoctrine()->getManager();
    }
    return $this->em;
  }
}
