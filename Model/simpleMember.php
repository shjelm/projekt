<?php

namespace model;

class SimpleMember{
	
	/**
	 * @var string
	 */
	private $firstName;
	
	/**
	 * @var string
	 */
	private $lastName;
	
	/**
	 * @var string
	 */
	private $class;
	
	/**
	 * @var string
	 */
	private $email;
	
	
	public function __construct($firstName, $lastName, $class, $email)
	{		
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->class = $class;
		$this->email = $email;		
	}
	
	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}
	
	/**
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}
	
	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
}