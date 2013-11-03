<?php

namespace model;

class loginModel{
	
	/** 
	 * Konstanter för hantering av fel-/rättmeddelanden
	 */	
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
	CONST UNVALIDDATEFORMAT = 23;
	CONST EMPTYFORMEVENT = 24;
	CONST UNVALIDTIMEFORMAT = 25;
	CONST ADDINGEVENTSUCCES = 26;
	CONST UPDATEDEVENT = 27;
	CONST EXISTINGEVENT = 28;
	CONST DELETEDEVENT = 29;
	CONST UNEXISTINGTITLE = 30;
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
	
	/**
	 * @var /model/LoginDAL
	 */
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
	 * @param /model/member
	 * @return int
	 */	
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
		
		if($this->unvalidDateFormat($paydate)){
			return self::UNVALIDDATEFORMAT;
		}
		
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
	
	/**
	 * @param /model/event
	 * @return bool
	 */	
	public function checkValidEvent(event $event)
	{
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();
		$eventTime = $event ->getEventTime();		
		$info = $event->getInfo();
		
		if(empty($title) || empty($eventDate) || empty($info) || empty($eventTime))
		{
			 return false;
		}		
		else if($this->unvalidDateFormat($eventDate))
		{
			return false;
		}
		else if($this->unvalidTimeFormat($eventTime))
		{
			return false;
		}
		else 
		{
			return true;
		}
	}	
	
	/**
	 * @param string
	 * @return bool
	 */
	public function checkValidDateForUpdate($date)
	{
		if(empty($date) || $this->unvalidDateFormat($date))
		{
			return false;
		}
		else{
			return true;
		}
		
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function checkValidTimeForUpdate($time)
	{
		if(empty($time) || $this->unvalidTimeFormat($time))
		{
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
	 * @param /model/event
	 * @return int
	 */
	public function checkUnvalidEvent(event $event)
	{
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();
		$eventTime = $event ->getEventTime();		
		$info = $event->getInfo();
		
		if(empty($title) || empty($eventDate) || empty($info) || empty($eventTime) )
		{
			 return self::EMPTYFORMEVENT;
		}	
		
		if($this->unvalidDateFormat($eventDate))
		{
			 return self::UNVALIDDATEFORMAT;
		}
		
		if($this->unvalidTimeFormat($eventTime))
		{
			 return self::UNVALIDTIMEFORMAT;
		}	
		else{
			return self::ADDINGEVENTSUCCES;
		}	
	}
	
	/**
	 * @return int
	 */
	public function alreadyExistingPnr()
	{
		return self::EXISTINGPNR;
	}
	
	/**
	 * @return bool
	 */
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
	
	/**
	 * @return bool
	 */
	public function eventExists($title, $date)
	{
		if(isset($title) && isset($date))
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return int
	 */
	public function alreadyExistingEvent()
	{
		return self::EXISTINGEVENT;
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidDateFormat($date)
	{
		preg_match('/^([1-2]{1}[0-9]{3})-([0-1]{1}[0-9]{1})-([0-2]{1}[0-9]{1})$/', $date, $matches);
		$valid = count($matches);
		if($valid == 4){
			return false;
		}
		else{
			return true;
		}
				
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidTimeFormat($time)
	{
		preg_match('/^([0-2]{1}[0-9]{1}):([0-5]{1}[0-9]{1})$/', $time, $matches);
		$valid = count($matches);
		if($valid == 3){
			return false;
		}
		else{
			return true;
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
	public function unexistingPnr()
	{
		return self::UNEXISTINGPNR;
	}
	
	/**
	 * @return int
	 */
	public function unexistingEvent()
	{
		return self::UNEXISTINGTITLE;
	}
	
	/**
	 * @param /model/member
	 * @return bool
	 */
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
		else if ($this->unvalidDateFormat($paydate)){
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
	
	/**
	 * @return bool
	 */
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
	
	/**
	 * @param string
	 */
	public function savePnr($pnr)
	{
		if(isset($_SESSION[self::$mySession])){
			$_SESSION[self::$mySession] = array();
			$_SESSION[self::$mySession]["Pnr"] = $pnr;
		}
		
	}
	
	/**
	 * @param string
	 */
	public function saveTitle($title)
	{
		if(isset($_SESSION[self::$mySession])){
			$_SESSION[self::$mySession] = array();
			$_SESSION[self::$mySession]["Title"] = $title;
		}
		
	}
	
	/**
	 * @param string
	 */
	public function saveUsername($username)
	{
		if(isset($_SESSION[self::$memberSession])){
			$_SESSION[self::$memberSession] = array();
			$_SESSION[self::$memberSession]["Username"] = $username;
		}
	}
	
	/**
	 * @return string
	 */
	public function getUsername()
	{
		if(isset($_SESSION[self::$memberSession]["Username"])){
			return $_SESSION[self::$memberSession]["Username"];
		}
	}
	
	/**
	 * @return int
	 */
	public function memberUpdated()
	{
		return self::UPDATEDMEMBER;
	}
	
	/**
	 * @return int
	 */
	public function eventUpdated()
	{
		return self::UPDATEDEVENT;
	}
	
	/**
	 * @return int
	 */
	public function eventUpdatedDateFail()
	{
		return self::UNVALIDDATEFORMAT;
	}
	
	/**
	 * @return int
	 */
	public function eventUpdatedTimeFail()
	{
		return self::UNVALIDTIMEFORMAT;
	}
	
	/**
	 * @return int
	 */
	public function memberDeleted()
	{
		return self::DELETEDMEMBER;
	}
	
	/**
	 * @return int
	 */	
	public function eventDeleted()
	{
		return self::DELETEDEVENT;
	}
	
	/**
	 * @return string
	 */
	public function getPnr()
	{
		if(isset($_SESSION[self::$mySession])){
			return $_SESSION[self::$mySession]["Pnr"];
		}
	}
	
	/**
	 * @return string
	 */
	public function getTitle()
	{
		if(isset($_SESSION[self::$mySession])){
			return $_SESSION[self::$mySession]["Title"];
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

	/**
	 * @return string
	 */
	public function getEndTime()
	{
		$end = file_get_contents("endtime.txt");
		return $end;
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
	 * @return string
	 */
	public function cryptPassword($pass)
	{
		return md5($pass."crypt");
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
