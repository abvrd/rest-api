<?php
/**
 * Class provider which will grab user information given and put it into a User-like object
 */

namespace ApiBundle\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

class UserProvider implements UserProviderInterface {
  /**
   * @var EntityManager
   */
  protected $manager;

  /**
   * @var string
   */
  protected $class;

  /**
   * @param EntityManager $em the entity manager to access the data model
   */
  public function __construct(EntityManager $em) {
    $this->manager = $em->getRepository('ApiBundle:User');
    $this->class = 'ApiBundle\Entity\User';
  }

  public function loadUserByUsername($username) {
    // looking for a user asssuming username could be username/email
    $query = $this->manager
            ->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery();

    try {
      // retrieving the user from the database
      $user = $query->getSingleResult();
    } catch(NoResultException $e) {
      // throw an exception if not found
      $message = sprintf(
        'Unable to find an active admin ApiBundle:User object identified by "%s".',
        $username
      );
      throw new UsernameNotFoundException($message, 0, $e);
    }

    return $user;
  }

  public function refreshUser(UserInterface $user) {
    $class = get_class($user);
    // check we are going to process an object of User class
    if (!$this->supportsClass($class)) {
        throw new UnsupportedUserException(
            sprintf(
                'Instances of "%s" are not supported.',
                $class
            )
        );
    }

    return $this->manager->find($user->getId());
  }

  public function supportsClass($class) {
    return $this->class === $class
          || is_subclass_of($class, $this->class);
  }

}
