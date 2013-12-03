<?php

namespace model;

require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';

class loginModel{
	
	/** 
	 * Konstanter för hantering av fel-/rättmeddelanden
	 */	
	CONST CORRECTUSERCREDENTIALS = 1;
	CONST EMPTYUSERNAME = 2;
	CONST EMPTYPASSWORD = 3;
	CONST INCORRECTUSERCREDENTIALS = 4;
	CONST USERLOGOUT = 5;
	CONST CORRECTCHANGE = 20;
	CONST INCORRECTCHANGE = 21;
	CONST UNVALIDTIMEFORMAT = 25;
	CONST UNVALIDLENGTHPASSWORD = 31;
	CONST DEFAULTMSG = 999;
		
	/**
	 * @var string
	 */
	private static $mySession = "mySession";
	
	/**
	 * @var string
	 */
	private static $memberSession = "memberSession";
	
	/**
	 * @var string
	 */
	private static $username ="Admin";
	
	/**
	 * @var string
	 */
	private static $password = "Password";	
	
	/**
	 * @var string
	 */
	private static $USERNAME = "Username";
	
	/**
	 * @var string
	 */
	private static $TITLE = "Title";
	
	/**
	 * @var string
	 */
	private static $PNR = "Pnr";
	
	
	public function __construct()
	{
		$this->loginDAL = new \model\loginDAL();
		$this->checkModel = new \Model\checkModel();;
	}
	
	/**
	 * @param string $username
	 * @param string $password
	 * @return int
	 */	
	public function checkMessageNr($username, $password)
	{
		if ($username == self::$username && $password == md5(self::$password."crypt") || $this->checkLogin($username,$password)) {
			
			$_SESSION[self::$mySession] = true;	
			return self::CORRECTUSERCREDENTIALS;
		} 
		else if (empty($username)) {
			return self::EMPTYUSERNAME; 
		} 
		else if ($password == md5(''."crypt")) {
			return self::EMPTYPASSWORD;
		}
		else {
			 return self::INCORRECTUSERCREDENTIALS;
		}
	}	
	
	/**
	 * @return int
	 */
	public function correctChangeOfPasswords()
	{
		return self::CORRECTCHANGE;
	}
	
	/**
	 * @return int
	 */
	public function incorrectChangeOfPasswords()
	{
		return self::INCORRECTCHANGE;
	}
	
	/**
	 * @return int
	 */
	public function unvalidLengthPassword()
	{
		return self::UNVALIDLENGTHPASSWORD;
	}
		
	/**
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */	
	public function checkLogin($username, $password)
	{
		if ($username == self::$username && $password == md5(self::$password."crypt")){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function checkMemberLoggedIn()
	{
		if (isset($_SESSION[self::$memberSession])){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * @param bool $logout
	 * @return bool
	 */	
	public function checkLogout($logout)
	{
		if($logout)
		{
			$this->destroySession();			
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return int
	 */
	public function noMsg()
	{
		return self::DEFAULTMSG;
	}
	
	/**
	 * @param bool $logout
	 * @return int
	 */
	public function setLogout($logout)
	{
		if($logout)
		{		
			return self::USERLOGOUT;
		}
	}
	
	/**
	 * @return bool
	 */	
	public function checkLoggedIn()
	{
		if(isset($_SESSION[self::$mySession])){
			
			return true;
		}
		else {
			return false;
		}
	}
	
	public function destroySession()
	{
		if(isset($_SESSION[self::$mySession])){
			unset($_SESSION[self::$mySession]);
		}
		if(isset($_SESSION[self::$memberSession])){
			unset($_SESSION[self::$memberSession]);
		}
	}
	
	/**
	 * @param string
	 */
	public function saveUsername($username)
	{
		if(isset($_SESSION[self::$memberSession])){
			$_SESSION[self::$memberSession] = array();
			$_SESSION[self::$memberSession][self::$USERNAME] = $username;
		}
	}
	
	/**
	 * @return string
	 */
	public function getUsername()
	{
		if(isset($_SESSION[self::$memberSession][self::$USERNAME])){
			return $_SESSION[self::$memberSession][self::$USERNAME];
		}
	}
		
	/**
	 * @param array
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function checkIfUserExists($existingUsernames, $username, $pass)
	{
		$passFromDb = $this->loginDAL->getPassword($username);
		$valid = false;
		for($i = 0; $i < count($existingUsernames); $i++)
			{
				if($username == $existingUsernames[$i] && $pass == $passFromDb[0]) {
					return true;
				}
			}
		return false;
	}
	
	/**
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function comparePasswords($newpass, $repeatedpass)
	{
		$emptyPass = md5(''."crypt");
		
		if($newpass == $emptyPass|| $repeatedpass == $emptyPass){
			return false;			
		}
		else{
			if($newpass == $repeatedpass){
				return true;
			}
			else{
				return false;
			}
		}
	}
	
	public function userCanLogIn()
	{
		$_SESSION[self::$memberSession] = true;
	}
}
