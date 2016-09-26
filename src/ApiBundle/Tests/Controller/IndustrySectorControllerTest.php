<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndustrySectorControllerTest extends WebTestCase {

  public function testPostSectors() {
      $client = static::createClient();

      $cawler = $client->request('POST', '/api/sectors', array('name' => 'Mon Secteur', 'internal_name' => 'mysector'));

      // Assert a specific 201 status code
      $this->assertEquals(
          Symfony\Component\HttpFoundation\Response::HTTP_CREATED,
          $client->getResponse()->getStatusCode()
      );
  }
}
