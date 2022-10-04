<?php
// src/Events/UserListener.php

namespace App\Events;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use App\Entity\User;

class UserListener
{

	/** @var PasswordHasherFactory */
	private $passwordHasherFactory;

	public function __construct()
	{
		$this->passwordHasherFactory = new PasswordHasherFactory([
			// auto hasher with default options for the User class (and children)
			User::class => ['algorithm' => 'auto'],

			// auto hasher with custom options for all PasswordAuthenticatedUserInterface instances
			PasswordAuthenticatedUserInterface::class => [
				'algorithm' => 'auto',
				'cost' => 15,
			],
		]);
	}

	/** @Orm\PrePersist */
	public function prePersist(User $user, LifecycleEventArgs $args)
	{
		$password = $user->getPassword();
		$password = $this->encodePassword($user, $password);
		$user->setPassword($password);
	}

	/** @Orm\PreUpdate */
	public function preUpdate(User $user, PreUpdateEventArgs $args)
	{
		if ($args->hasChangedField('password')) {
			$password = $args->getNewValue('password');
			$password = $this->encodePassword($user, $password);
			$user->setPassword($password);
		}
	}

	private function encodePassword(User $user, string $password)
	{
		$passwordHasher = new UserPasswordHasher($this->passwordHasherFactory);
		return $passwordHasher->hashPassword($user, $password);
	}
}
