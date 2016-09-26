<?php

namespace ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ApiBundle\Entity\User;

class LoadUserData implements FixtureInterface {

  public function load(ObjectManager $manager) {
    $user = new User();
    $user->setUsername('abvrd');
    $user->setPassword(md5('astrongpassword'));
    $user->setEmail('bouvardcontact@gmail.com');

    $user->setIsActive(true);

    $user->setApiKey('ZGRiMWQxZDhjODc2MzZhZDhhYzIyNzljZWZkYmFmZWU0NTU2MzVlZTE0ZjkzZWZhYjEzYzFmYWMxY2NjYzZhMg');

    $manager->persist($user);
    $manager->flush();
  }
}
