<?php
// src/Events/UserListener.php

namespace App\Events;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use App\Entity\Customer;

class CustomerListener
{

	/** @var PasswordHasherFactory */
	private $passwordHasherFactory;

	public function __construct()
	{
		$this->passwordHasherFactory = new PasswordHasherFactory([
			// auto hasher with default options for the User class (and children)
			Customer::class => ['algorithm' => 'auto'],

			// auto hasher with custom options for all PasswordAuthenticatedUserInterface instances
			PasswordAuthenticatedUserInterface::class => [
				'algorithm' => 'auto',
				'cost' => 15,
			],
		]);
	}

	/** @Orm\PrePersist */
	public function prePersist(Customer $customer, LifecycleEventArgs $args)
	{
		$password = $customer->getPassword();
		$password = $this->encodePassword($customer, $password);
		$customer->setPassword($password);
	}

	/** @Orm\PreUpdate */
	public function preUpdate(Customer $customer, PreUpdateEventArgs $args)
	{
		if ($args->hasChangedField('password')) {
			$password = $args->getNewValue('password');
			$password = $this->encodePassword($customer, $password);
			$customer->setPassword($password);
		}
	}

	private function encodePassword(Customer $customer, string $password)
	{
		$passwordHasher = new UserPasswordHasher($this->passwordHasherFactory);
		return $passwordHasher->hashPassword($customer, $password);
	}
}
