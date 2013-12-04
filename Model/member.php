<?php

namespace model;

class Member{
	
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
	private $personalnr;
	
	/**
	 * @var string
	 */
	private $class;
	
	/**
	 * @var string
	 */	 
	private $phonenr;
	
	/**
	 * @var string
	 */
	private $email;
	
	/**
	 * @var string
	 */
	private $address;
	
	/**
	 * @var date
	 */
	private $paydate;
		
	/**
	 * @var string
	 */
	private $username;
	
	/**
	 * @var string
	 */
	private $password;
	
	
	public function __construct($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->personalnr = $personalnr;
		$this->class = $class;
		$this->phonenr = $phonenr;
		$this->email = $email;
		$this->address = $address;
		$this->paydate = $paydate;
		$this->username = $this->generateUsername($firstName, $lastName, $personalnr);
		$this->password = $this->generateDefaultPassword();
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
	public function getPersonalNr()
	{
		return $this->personalnr;
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
	public function getPhoneNr()
	{
		return $this->phonenr;
	}
	
	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * @return string
	 */
	public function getAddres()
	{
		return $this->address;
	}
	
	/**
	 * @return date
	 */
	public function getPayDate()
	{
		return $this->paydate;
	}
	
	/**
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}	
	
	/**
	 * @return string
	 */
	public function generateUsername($firstName, $lastName, $pnr)
	{
		$name = preg_replace('/\s+/', '', $name);
		$username = substr($firstName, 0,3);
		$username .= substr($lastName, 0,3);
		$username .= substr($pnr, 0,6);
		
		return $username;
	}	
	
	/**
	 * @return string
	 */
	public function generateDefaultPassword()
	{
		$password = md5('Newpassword'."crypt");
		
		$this->password = $password;
		
		return $password;
	}
}