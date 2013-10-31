<?php

namespace view;

class loginView{
		
	CONST CORRECTUSERCREDENTIALS = 1;
	CONST EMPTYUSERNAME = 2;
	CONST EMPTYPASSWORD = 3;
	CONST INCORRECTUSERCREDENTIALS = 4;
	CONST USERLOGOUT = 5;
	CONST SAVECREDENTIALS = 6;
	CONST VALIDSAVEDCREDENTIALS = 7;
	CONST EMPTYFORM = 14;
	CONST UNVALIDPNR = 15;
	CONST ADDINGMEMBERSUCCES = 16;
	CONST DEFAULTMSG = 999;
	
	private static $NAME = "name";
	private static $PERSONALNR = "personalNr";
	private static $ADDRESS = "address";
	private static $EMAIL = "email";
	private static $PHONENR = "phoneNr";
	private static $CLASS = "class";
	private static $PAYDATE = "payDate";
	
	
	
	private $html;
	
	/**
	 * @var string
	 */
	private static $username = "UserName";
	
	/**
	 * @var string
	 */
	private static $password = "Password";
	
	/**
	 * @var string
	 */
	private static $logOut = "logout";
	
	/**
	 * @var string
	 */
	private static $autoLogin = "AutoLogin";
	
	/**
	 * @var string
	 */
	private $cryptedPassword = "";
	
	/**
	 * @var int
	 */
	private static $endtme;
	
	/**
	 * @var array
	 */
	 private $fixedMembers;
	 
	 private $HTMLMemberTable;
	
	/**
	 * @return string
	 */
	public function getUsername(){
		if($_POST || $_GET){
			if(isset($_POST[self::$username])){
				$username = $_POST[self::$username];
				
				return $username;
			}
		}
	}
	
	public function isAddingMember() {
		if (isset($_GET["addMember"])) {
			return true;
		}
	}
	
	public function isShowingMembers() {
		if (isset($_GET["showAllMembers"])) {
			return true;
		}
	}
	
	public function isShowingMember() {
		if (isset($_GET["showMember"])) {
			return true;
		}
	}
	
	/**
	 * @return string
	 */
	public function getPassword()
	{
		if($_POST || $_GET){
			if(isset($_POST[self::$password])){	
				$password = $_POST[self::$password];
			
				return md5($password."crypt");
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function setMessage($message)
	{
		if($_GET){
			switch ($message) {
				
				case self::CORRECTUSERCREDENTIALS:
					$this->messageString = '<p class="alert alert-success">Inloggningen lyckades</p>';	
					
					if(self::checkAutoLogin())
					{
						$this->messageString = '<p class="alert alert-success">Inloggningen lyckades och vi kommer ihåg dig nästa gång</p>';
					}			
					break;
					
				case self::EMPTYUSERNAME: 
					$this->messageString = '<p class="alert alert-danger">Användarnamn saknas</p>';
					break;
	
				case self::EMPTYPASSWORD: 
					$this->messageString = '<p class="alert alert-danger">Lösenord saknas</p>';
					break;		
					
				case self::INCORRECTUSERCREDENTIALS:
					$this->messageString = '<p class="alert alert-danger">Felaktigt användarnamn och/eller lösenord</p>';	
					break;
					
				case self::USERLOGOUT:
					$this->messageString = '<p class="alert alert-info">Du har nu loggat ut</p>';	
					break;
				
				case self::SAVECREDENTIALS:
					$this->messageString = '<p class="alert alert-success">Inloggning lyckad med cookies</p>';	
					break;
				case self::VALIDSAVEDCREDENTIALS:
					$this->messageString = '<p class="alert alert-danger">Felaktig information i cookie</p>';	
					break;
				case self::EMPTYFORM:
					$this->messageString = '<p class="alert alert-danger">Alla fält, förutom betalat till, måste fyllas i</p>';	
					break;	
				case self::UNVALIDPNR:
					$this->messageString = '<p class="alert alert-danger">Du måste ange ett giltigt personnummer</p>';	
					break;				
				case self::ADDINGMEMBERSUCCES:
					$this->messageString = '<p class="alert alert-success">Medlemmen har registrerats</p>';	
					break;	
					
				default:
					$this->messageString = '';
			}
			return $this->messageString;
		}
	}
	
	/**
	 * @return bool
	 */	
	public function checkFormSent()
	{
		if($_POST){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function checkLogout(){
		if($_POST){
			if (isset($_GET[self::$logOut])){
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
	
	/**
	 * @return bool
	 */
	public function checkAutologin()
	{
		if($_GET){
			if(isset($_POST[self::$autoLogin])){
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	public function destroyCredentials()
	{
		setcookie(self::$username, "",time()-3600);
		setcookie(self::$password, "",time()-3600);
	}
	
	/**
	 * @return bool
	 */
	public function canSaveCredentials()
	{
		if (isset($_COOKIE[self::$username]) && isset($_COOKIE[self::$password]))
		{
			return true;
		}
		else 
		{
			return false;	
		}
	}
	
	/**
	 *@param string $username 
	 *@param int $end
	 * @return bool
	 */	
	public function correctSavedCredentials($username, $end)
	{
		if(self::canSaveCredentials()){
			if($_COOKIE[self::$username] == $username  &&  $_COOKIE[self::$password] == md5(self::$password."crypt") 
				&& $end > time())
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
	
	/**
	 * @param string $username
	 * @param string $password
	 * @param int $end
	 */
	public function autoLogin($username, $password, $endtime){
		
		setcookie(self::$username, $username, $endtime);
		$this->cryptedPassword = md5($password . "crypt");
		setcookie(self::$password, $this->cryptedPassword, $endtime);	
	}
	
	
	/**
	 * @return string
	 */
	public function getCryptedPassword()
	{
		if(isset($_COOKIE[self::$password])){	
			return $this->cryptedPassword; 
		}
	}
	
	public function setMember()
	{
		if($_POST){
			$name = $_POST[self::$NAME];
			$personalnr = $_POST[self::$PERSONALNR];
			$address = $_POST[self::$ADDRESS];
			$email = $_POST[self::$EMAIL];
			$phonenr = $_POST[self::$PHONENR];
			$class = $_POST[self::$CLASS];
			$paydate = $_POST[self::$PAYDATE];
		
			$array = array();
			
			array_push($array, $name);
			array_push($array, $personalnr);		
			array_push($array, $class);
			array_push($array, $email);
			array_push($array, $phonenr);
			array_push($array, $address);
			array_push($array, $paydate);
		
		}
		return $array;
	}
	public function showMembers($members)
	{
		/**$this->HTMLMemberTable = array();
		
		array_push($this->HTMLMemberTable, '<table>'); 
		array_push($this->HTMLMemberTable, '<tr>') ;
		for ($i=0; $i < count($members) ; $i += 7) {
		
			array_push($this->HTMLMemberTable, '<td>'.$members[$i].'</td>');
			
			
			
		}
		array_push($this->HTMLMemberTable, '</tr>') ;
		array_push($this->HTMLMemberTable, '<tr>') ;
		for ($i=1; $i < count($members); $i += 7) { 
				array_push($this->HTMLMemberTable, '<td>'.$members[$i].'</td>');
				
				
			}
		array_push($this->HTMLMemberTable, '</tr>') ;
		array_push($this->HTMLMemberTable, '<tr>') ;
		for ($i=2; $i < count($members); $i += 7) { 
					array_push($this->HTMLMemberTable, '<td>'.$members[$i].'</td>');
				}
		array_push($this->HTMLMemberTable, '</tr>') ;
		array_push($this->HTMLMemberTable, '</table>'); 
		var_dump($this->HTMLMemberTable);
		return $this->HTMLMemberTable;*/
		return $members;
	}
	
	public function getNewRow()
	{
		return '<br>';
	}
}
