<?php

namespace PiouPiou\AgriGestionBundle\EventListener;

use PiouPiou\RibsAdminBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CreateUpdateAwareListener
{
	/**
	 * @var User
	 */
	private $user;

    /**
     * GuidAwareListener constructor.
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
	{
        $this->user = $tokenStorage->getToken()->getUser()->getUser();
	}
	
	public function prePersist($entity)
	{
		if ($entity->getCreatedBy() === null) {
            $entity->setCreatedBy($this->user);
		}
        if ($entity->getUpdatedBy() === null) {
            $entity->setUpdatedBy($this->user);
        }
	}

    public function preUpdate($entity)
    {
        $entity->setUpdatedBy($this->user);
    }
}
