<?php

namespace model;

class Member{
	
	/**
	 * @var string
	 */
	private $name;
	
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
	 * @var \model\loginDAL
	 */
	private $loginDAL;
	
	/**
	 * @var string
	 */
	private $username;
	
	/**
	 * @var string
	 */
	private $password;
	
	
	public function __construct($name, $personalnr, $class, $phonenr, $email, $address, $paydate)
	{
		$this->loginDAL = new \model\LoginDAL;
		
		$this->name = $name;
		$this->personalnr = $personalnr;
		$this->class = $class;
		$this->phonenr = $phonenr;
		$this->email = $email;
		$this->address = $address;
		$this->paydate = $paydate;
		$this->username = $this->generateUsername($name, $personalnr);
		$this->password = md5($this->generatePassword($name, $pnr, $address))."crypt";
		
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
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
	public function generateUsername($name, $pnr)
	{
		$un = substr($name, 0,3);
		$un .= substr($pnr, 0,6);
		return $un;
	}
	
	
	/**
	 * @return string
	 */
	public function generatePassword($name, $pnr, $address)
	{
		$un = substr($name, 0,3);
		$un .= substr($pnr, 0,6);
		$un .= substr($address, 0,2);
		
		$this->password = $un;
		return $un;
		
	}
}