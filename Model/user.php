<?php

namespace model;

class User{
	
	private $name;
	private $personalnr;
	private $class;
	private $phonenr;
	private $email;
	private $address;
	private $paydate;
	private $loginDAL;
	
	
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
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getPersonalNr()
	{
		return $this->personalnr;
	}
	
	public function getClass()
	{
		return $this->class;
	}
	
	public function getPhoneNr()
	{
		return $this->phonenr;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getAddres()
	{
		return $this->address;
	}
	
	public function getPayDate()
	{
		return $this->paydate;
	}
}
