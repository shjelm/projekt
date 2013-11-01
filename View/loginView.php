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
	private static $NAME = "name";
	
	/**
	 * @var string
	 */
	private static $PERSONALNR = "personalNr";
	
	/**
	 * @var string
	 */
	private static $ADDRESS = "address";
	
	/**
	 * @var string
	 */
	private static $EMAIL = "email";
	
	/**
	 * @var string
	 */
	private static $PHONENR = "phoneNr";
	
	/**
	 * @var string
	 */
	private static $CLASS = "class";
	
	/**
	 * @var date
	 */
	private static $PAYDATE = "payDate";
	
	/**
	 * @var string
	 */
	private static $NEWNAME = "newName";
	
	/**
	 * @var string
	 */
	private static $NEWPERSONALNR = "newPersonalNr";
	
	/**
	 * @var string
	 */
	private static $NEWADDRESS = "newAddress";
	
	/**
	 * @var string
	 */
	private static $NEWEMAIL = "newEmail";
	
	/**
	 * @var string
	 */
	private static $NEWPHONENR = "newPhoneNr";
	
	/**
	 * @var string
	 */
	private static $NEWCLASS = "newClass";
	
	/**
	 * @var string
	 */
	private static $NEWPAYDATE = "newPayDate";
	
	/**
	 * @var string
	 */
	private $html;
	
	/**
	 * @var string
	 */
	private static $UPDATE = "update";
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
	 * @var string
	 */
	private static $showAllMembersSimple = "showAllMembersSimple";
	
	
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
	
	/**
	 * @return bool
	 */
	public function isAddingMember() {
		if (isset($_GET["addMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isShowingMembers() {
		if (isset($_GET["showAllMembers"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isShowingPayingMembers() {
		if (isset($_GET["payingMembers"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isShowingNotPayingMembers() {
		if (isset($_GET["notPayingMembers"])) {
			return true;
		}
		else{
			return false;
		}
	}
	/**
	 * @return bool
	 */
	public function isShowingMembersSimple() {
		if (isset($_GET[self::$showAllMembersSimple])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	
	/**
	 * @return bool
	 */
	public function isSearchingMember() {
		if (isset($_POST["searchMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	public function isWantingDeletingMember()
	{
		if (isset($_GET["deleteMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	public function isDeletingMember()
	{
		if (isset($_POST["delete"])) {
			return true;
		}
		else{
			return false;
		}
	}
	/**
	 * @return bool
	 */
	public function isShowingMember() {
		if (isset($_GET["showMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingMember() {
		if (isset($_GET["updateMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isSavingUpdatedMember() {
		if (isset($_POST[self::$UPDATE])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingName()
	{
		if (!empty($_POST[self::$NEWNAME])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingAddress()
	{
		if (!empty($_POST[self::$NEWADDRESS])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingEmail()
	{
		if (!empty($_POST[self::$NEWEMAIL])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingPhonenr()
	{
		if (!empty($_POST[self::$NEWPHONENR])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingClass()
	{
		if (!empty($_POST[self::$NEWCLASS])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingPaydate()
	{
		if (!empty($_POST[self::$NEWPAYDATE])) {
			return true;
		}
		else{
			return false;
		}	
	}
	/**
	 * @return bool
	 */
	public function isShowingChangingPassword()
	{
		if (isset($_GET["changePassword"])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isChangingPassword()
	{
		if (isset($_POST["changePass"])) {
			return true;
		}
		else{
			return false;
		}	
	}
	

	/**
	 * @return string
	 */
	public function getMemberAdminWantsToShow()
	{
		if(isset($_POST["searchMember"])){
			return $_POST["searchMember"];
		}	
	}
	
	/**
	 * @return string
	 */
	public function getMemberAdminWantsToUpdate(){
		if(isset($_GET["updateMember"])){
			return $_POST["searchMember"];
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
	public function getNewPassword()
	{
		if($_POST || $_GET){
			if(isset($_POST["changePasswordField"])){	
				$password = $_POST["changePasswordField"];	
				return md5($password."crypt");
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function getRepeatedNewPassword()
	{
		if($_POST || $_GET){
			if(isset($_POST["repeatPasswordField"])){	
				$password = $_POST["repeatPasswordField"];	
				return md5($password."crypt");
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWNAME])){
				return $_POST[self::$NEWNAME];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getAddress()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWADDRESS])){
				return $_POST[self::$NEWADDRESS];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getEmail()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWEMAIL])){
				return $_POST[self::$NEWEMAIL];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getPhonenr()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWPHONENR])){
				return $_POST[self::$NEWPHONENR];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getClass()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWCLASS])){
				return $_POST[self::$NEWCLASS];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getPaydate()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWPAYDATE])){
				return $_POST[self::$NEWPAYDATE];
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
					
				case self::UNEXISTINGPNR:
					$this->messageString = '<p class="alert alert-danger">Personnumret är ej registrerat</p>';	
					break;
					
				case self::EXISTINGPNR:
					$this->messageString = '<p class="alert alert-danger">Personnumret är redan registrerat</p>';	
					break;	
					
				case self::UPDATEDMEMBER:
					$this->messageString = '<p class="alert alert-success">Medlemmen har uppdaterats</p>';	
					break;	
					
				case self::CORRECTCHANGE:
					$this->messageString = '<p class="alert alert-success">Lösenordet har ändrats</p>';	
					break;						
				
				case self::INCORRECTCHANGE:
					$this->messageString = '<p class="alert alert-danger">Lösenorden måste stämma överens</p>';	
					break;	
					
				case self::DELETEDMEMBER:
					$this->messageString = '<p class="alert alert-success">Medlemmen har raderats</p>';	
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
	 * @param string $username 
	 * @param int $end
	 * @return bool
	 */	
	public function correctSavedCredentials($username, $end)
	{//TODO: KUnna funka med cookie
		if(self::canSaveCredentials()){
			var_dump($_COOKIE[self::$password], md5(self::$password."crypt"));
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
	
	/**
	 * @return array
	 */
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
			array_push($array, $phonenr);
			array_push($array, $email);
			array_push($array, $address);
			array_push($array, $paydate);
		
		}
		return $array;
	}
	
	/**
	 * @return HTML string
	 */
	public function getNewRow()
	{
		return '<br>';
	}
}
