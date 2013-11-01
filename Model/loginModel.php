<?php

namespace model;

class loginModel{
	
	CONST CORRECTUSERCREDENTIALS = 1;
	CONST EMPTYUSERNAME = 2;
	CONST EMPTYPASSWORD = 3;
	CONST INCORRECTUSERCREDENTIALS = 4;
	CONST USERLOGOUT = 5;
	CONST SAVECREDENTIALS = 6;
	CONST VALIDSAVEDCREDENTIALS = 7;
	CONST EMPTYNAME = 8;
	CONST EMPTYPNR = 9;
	CONST EMPTYADDRESS = 10;
	CONST EMPTYEMAIL = 11;
	CONST EMPTYPHNR = 12;
	CONST EMPTYCLASS = 13;
	CONST EMPTYFORM = 14;
	CONST UNVALIDPNR = 15;
	CONST ADDINGMEMBERSUCCES = 16;
	CONST UNEXISTINGPNR = 17;
	CONST EXISTINGPNR = 18;
	CONST UPDATEDMEMBER = 19;
	CONST CORRECTCHANGE = 20;
	CONST INCORRECTCHANGE = 21;
	CONST DELETEDMEMBER = 22;
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
	 * @var bool
	 */
	private static $checkBrowser = "checkBrowser";
	
	/**
	 * @var string
	 */
	private static $browser = "browser";
	
	private $loginDAL;
	
	
	public function __construct()
	{
		$this->loginDAL = new \model\loginDAL();
	}
	/**
	 * @return string
	 */
	public function getUser()
	{
		return self::$username;		
	}
	
	/**
	 * @return string
	 */
	public function getPass()
	{
		return self::$password;
	}
	
	/**
	 * @param string $username
	 * @param string $password
	 * @return int
	 */	
	public function checkMessageNr($username, $password)
	{
		if ($username == self::$username && $password == md5(self::$password."crypt")) {
			
			$_SESSION[self::$mySession] = true;	
			return self::CORRECTUSERCREDENTIALS;
		} 
		else if ($password == md5(''."crypt")) {
			return self::EMPTYPASSWORD;
		}
		else if (empty($username)) {
			return self::EMPTYUSERNAME; 
		} 
		else {
			 return self::INCORRECTUSERCREDENTIALS;
		}
	}
	
	public function checkUnvalidNewMember(member $member)
	{
		$name = $member->getName();
		$pnr = $member ->getPersonalNr();		
		$address = $member->getAddres();
		$phnr = $member->getPhoneNr();
		$email = $member->getEmail();		
		$class = $member->getClass();
		$paydate = $member->getPayDate();
		$username = $member->getUserName();
		
		if($this->unvalidPersonalnumber($pnr)){
			
			return self::UNVALIDPNR;
		}
		
		if(empty($name) || empty($pnr) || empty($address) || empty($phnr) ||
			empty($email) || empty($class))
		{
			 return self::EMPTYFORM;
		}
		else{
			return self::ADDINGMEMBERSUCCES;
		}
		
	}
	
	public function alreadyExistingPnr()
	{
		return self::EXISTINGPNR;
	}
	
	public function unvalidPersonalnumber($pnr)
	{
		preg_match('/^[0-9]{10}$/', $pnr, $matches);
		$valid = count($matches);
		if($valid == 1){
			return false;
		}
		else{
			return true;
		}
		
	}
	
	public function correctChangeOfPasswords()
	{
		return self::CORRECTCHANGE;
	}
	
	public function incorrectChangeOfPasswords()
	{
		return self::INCORRECTCHANGE;
	}
	
	public function unexistingPnr()
	{
		return self::UNEXISTINGPNR;
	}
	
	public function checkNewMemberValid(member $member)
	{
		$name = $member->getName();
		$pnr = $member ->getPersonalNr();		
		$address = $member->getAddres();
		$phnr = $member->getPhoneNr();
		$email = $member->getEmail();		
		$class = $member->getClass();
		$paydate = $member->getPayDate();
		$username = $member->getUserName();

		if(empty($name) || empty($pnr) || empty($address) || empty($phnr) ||
			empty($email) || empty($class))
		{
			return false;
		}
		else if ($this->unvalidPersonalnumber($pnr)){
			return false;
		}
		else{
			return true;
		}
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
	
	public function checkMemberLoggedIn()
	{
		//TODO: Hur fan ska jag kolla om medlemmen har loggat in med korrekta uppgifter för att kunna hållas inloggad?
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
	public function validSavedCredentialsMsg()
	{
			return self::VALIDSAVEDCREDENTIALS;
	}
	
	/**
	 * @return string
	 */
	public function noMsg()
	{
		return self::DEFAULTMSG;
	}
	
	/**
	 * @param boll $logout
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
	
	/**
	 * @return bool
	 */	
	public function checkBrowserUsed()
	{
		if(isset($_SESSION[self::$checkBrowser])){
			
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
		if(isset($_SESSION[self::$checkBrowser])){
			unset($_SESSION[self::$checkBrowser]);
		}
		if(isset($_SESSION[self::$memberSession])){
			unset($_SESSION[self::$memberSession]);
		}
	}
	
	public function savePnr($pnr)
	{
		if(isset($_SESSION[self::$mySession])){
			$_SESSION[self::$mySession] = array();
			$_SESSION[self::$mySession]["Pnr"] = $pnr;
		}
		
	}
	
	public function saveUsername($username)
	{
		if(isset($_SESSION[self::$memberSession])){
			$_SESSION[self::$memberSession] = array();
			$_SESSION[self::$memberSession]["Username"] = $username;
		}
	}
	
	public function getUsername()
	{
		if(isset($_SESSION[self::$memberSession]["Username"])){
			return $_SESSION[self::$memberSession]["Username"];
		}
	}
	
	public function memberUpdated()
	{
		return self::UPDATEDMEMBER;
	}
	
	public function memberDeleted()
	{
		return self::DELETEDMEMBER;
	}
	
	public function getPnr()
	{
		if(isset($_SESSION[self::$mySession])){
			return $_SESSION[self::$mySession]["Pnr"];
		}
		
	}
	
	public function getBrowser()
	{
		if (!isset($_SESSION[self::$checkBrowser])){
				$_SESSION[self::$checkBrowser] = array();
				$_SESSION[self::$checkBrowser][self::$browser] = self::getUserAgent();
			}		
	}
	
	/**
	 * @return bool
	 */	
	public function checkBrowser()
	{
		
		if(isset($_SESSION[self::$checkBrowser][self::$browser])){
			if($_SESSION[self::$checkBrowser][self::$browser] == self::getUserAgent()){
				return true;			
			}		
			else {
				return false;
			}
		}
	}
	
	/**
	 * @param bool
	 * @return int
	 */	
	public function setMsgSaveCredentials($canSaveCredentials)
	{
		if($canSaveCredentials){
			return 'saveCredentials';
		}
	}
	
	public function saveEndTime()
	{
		$endtime = time() + 3600;
		file_put_contents("endtime.txt", $endtime);		
	}

	public function getEndTime()
	{
		$end = file_get_contents("endtime.txt");
		return $end;
	}
	
	public function checkIfUserExists($existingUsernames, $username, $pass)
	{
		$passFromDb = $this->loginDAL->getPassword($username);
		$valid = false;
		//TODO: Skicka in ett lösenord från databasen istället
		for($i = 0; $i < count($existingUsernames); $i++)
			{
				if($username == $existingUsernames[$i] && $pass == $passFromDb[0]) {
					return true;
				}
			}
		return false;
	}
	
	public function cryptPassword($pass)
	{
		return md5($pass."crypt");
	}
	
	public function comparePasswords($newpass, $repeatedpass)
	{
		if($newpass == $repeatedpass){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function userCanLogIn()
	{
		$_SESSION[self::$memberSession] = true;
	}
	
	/*Magical fix from Emil*/
	public static function getUserAgent()
	{
	    static $agent = null;
	
	    if ( empty($agent) ) {
	        $agent = $_SERVER['HTTP_USER_AGENT'];
	
	        if ( stripos($agent, 'Firefox') !== false ) {
	            $agent = 'firefox';
	        } elseif ( stripos($agent, 'MSIE') !== false ) {
	            $agent = 'ie';
	        } elseif ( stripos($agent, 'iPad') !== false ) {
	            $agent = 'ipad';
	        } elseif ( stripos($agent, 'Android') !== false ) {
	            $agent = 'android';
	        } elseif ( stripos($agent, 'Chrome') !== false ) {
	            $agent = 'chrome';
	        } elseif ( stripos($agent, 'Safari') !== false ) {
	            $agent = 'safari';
	        } elseif ( stripos($agent, 'AIR') !== false ) {
	            $agent = 'air';
	        } elseif ( stripos($agent, 'Fluid') !== false ) {
	            $agent = 'fluid';
	        }	
	    }	
	    return $agent;
	}
}
