<?php

namespace view;

class loginView{
	
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
	 * @var string
	 */
	private static $deleteEvent = "deleteEvent";
	
	/**
	 * @var string
	 */
	private static $addMember = "addMember";
	
	
	/**
	 * @var string
	 */
	private static $showAllMembers = "showAllMembers";
	
	/**
	 * @var string
	 */
	private static $showEvents = "showEvents";
	
	/**
	 * @var string
	 */
	private static $wantsToAddEvent = "wantsToAddEvent";
	
	/**
	 * @var string
	 */
	private static $addEvent = "addEvent";
	
	/**
	 * @var string
	 */
	private static $wantsToUpdateEvent = "wantsToUpdateEvent";
	
	/**
	 * @var string
	 */
	private static $updateEvent = "updateEvent";
	
	/**
	 * @var string
	 */
	private static $updateThisEvent = "updateThisEvent";
	
	/**
	 * @var string
	 */
	private static $searchByEvent = "searchByEvent";
	
	/**
	 * @var string
	 */
	private static $payingMembers = "payingMembers";
	
	/**
	 * @var string
	 */
	private static $notPayingMembers = "notPayingMembers";
	
	/**
	 * @var string
	 */
	private static $searchMember = "searchMember";
	
	/**
	 * @var string
	 */
	private static $searchEvent = "searchEvent";
	
	/**
	 * @var string
	 */
	private static $updateMember = "updateMember";

	/**
	 * @var string
	 */
	private static $changePasswordField = "changePasswordField";
	
	/**
	 * @var string
	 */
	private static $repeatPasswordField = "repeatPasswordField";
	
	/**
	 * @var string
	 */
	private static $newDate = "newDate";
	
	/**
	 * @var string
	 */
	private static $newTime = "newTime";
	
	/**
	 * @var string
	 */
	private static $newInfo = "newInfo";
	
	/**
	 * @var string
	 */
	private static $changePassword = "changePassword";
	
	/**
	 * @var string
	 */
	private static $changePass = "changePass";

	/**
	 * @var string
	 */
	private static $eventTitle = "eventTitle";
	/**
	 * @var string
	 */
	private static $eventDate = "eventDate";
	
	/**
	 * @var string
	 */
	private static $eventTime = "eventTime";
	
	/**
	 * @var string
	 */
	private static $eventInfo = "eventInfo";
	
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
		if (isset($_GET[self::$addMember])) {
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
		if (isset($_GET[self::$showAllMembers])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isShowingEvents() {
		if (isset($_GET[self::$showEvents])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingToAddEvent() {
		if (isset($_GET[self::$wantsToAddEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isAddingEvent() {
		if (isset($_POST[self::$addEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingToUpdateEvent() {
		if (isset($_GET[self::$wantsToUpdateEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingEvent() {
		if (isset($_GET[self::$updateEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isSavingUpdatedEvent() {
		if (isset($_POST[self::$updateThisEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isSearchingEvent() {
		if (isset($_POST[self::$searchByEvent])) {
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
		if (isset($_GET[self::$payingMembers])) {
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
		if (isset($_GET[self::$notPayingMembers])) {
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
		if (isset($_POST[self::$searchMember])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingDeletingMember()
	{
		if (isset($_GET["deleteMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isDeletingMember()
	{
		if (isset($_POST["deleteThisMember"])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingDeletingEvent()
	{
		if (isset($_GET[self::$deleteEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isDeletingEvent()
	{
		if (isset($_GET[self::$deleteEvent])) {
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
		if (isset($_GET[self::$updateMember])) {
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
		if (isset($_POST["updateThisMember"])) {
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
	public function isUpdatingDate()
	{
		if (!empty($_POST[self::$newDate])) {
			return true;
		}
		else{
			return false;
		}	
	}
	/**
	 * @return bool
	 */
	public function isUpdatingTime()
	{
		if (!empty($_POST[self::$newTime])) {
			return true;
		}
		else{
			return false;
		}	
	}
	/**
	 * @return bool
	 */
	public function isUpdatingInfo()
	{
		if (!empty($_POST[self::$newInfo])) {
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
		if (isset($_GET[self::$changePassword])) {
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
		if (isset($_POST[self::$changePass])) {
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
		if(isset($_POST[self::$searchMember])){
			return $_POST[self::$searchMember];
		}	
	}
	
	/**
	 * @return string
	 */
	public function getEventAdminWantsToShow()
	{
		if(isset($_POST[self::$searchEvent])){
			return $_POST[self::$searchEvent];
		}	
	}
	
	/**
	 * @return string
	 */
	public function getMemberAdminWantsToUpdate(){
		if(isset($_GET[self::$updateMember])){
			return $_POST[self::$searchMember];
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
			if(isset($_POST[self::$changePasswordField])){	
				$password = $_POST[self::$changePasswordField];	
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
			if(isset($_POST[self::$repeatPasswordField])){	
				$password = $_POST[self::$repeatPasswordField];	
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
	public function getDate()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newDate])){
				return $_POST[self::$newDate];
			}
		}				
	}
	/**
	 * @return string
	 */
	public function getTime()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newTime])){
				return $_POST[self::$newTime];
			}
		}				
	}
	/**
	 * @return string
	 */
	public function getInfo()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newInfo])){
				return $_POST[self::$newInfo];
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
					
				case self::ADDINGEVENTSUCCES:
					$this->messageString = '<p class="alert alert-success">Evenemanget har skapats</p>';	
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
				
				case self::UPDATEDEVENT:
					$this->messageString = '<p class="alert alert-success">Evenemanget har uppdaterats</p>';	
					break;		
					
				case self::CORRECTCHANGE:
					$this->messageString = '<p class="alert alert-success">Lösenordet har ändrats</p>';	
					break;						
				
				case self::INCORRECTCHANGE:
					$this->messageString = '<p class="alert alert-danger">Lösenorden måste stämma överens och får ej vara tomma</p>';	
					break;	
					
				case self::DELETEDMEMBER:
					$this->messageString = '<p class="alert alert-success">Medlemmen har raderats</p>';	
					break;						
				
				case self::UNVALIDDATEFORMAT:
					$this->messageString = '<p class="alert alert-danger">Ange ett giltigt datum</p>';	
					break;
				
				case self::UNVALIDTIMEFORMAT:
					$this->messageString = '<p class="alert alert-danger">Ange en giltig tidpunkt</p>';	
					break;		
					
				case self::EMPTYFORMEVENT:
					$this->messageString = '<p class="alert alert-danger">Alla fält måste fyllas i</p>';	
					break;
				
				case self::EXISTINGEVENT:
					$this->messageString = '<p class="alert alert-danger">Evenemanget är redan registrerat</p>';	
					break;	

				case self::DELETEDEVENT:
					$this->messageString = '<p class="alert alert-success">Evenemanget har raderats</p>';	
					break;	
				
				case self::UNEXISTINGTITLE:
					$this->messageString = '<p class="alert alert-danger">Evenemanget är ej registrerat</p>';	
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
	
	public function destroyCredentials()
	{
		setcookie(self::$username, "",time()-3600);
		setcookie(self::$password, "",time()-3600);
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
	 * @return array
	 */
	public function setEvent()
	{
		if($_POST){
			$title = $_POST[self::$eventTitle];
			$eventDate = $_POST[self::$eventDate];
			$eventTime = $_POST[self::$eventTime];
			$info = $_POST[self::$eventInfo];
		
			$array = array();
			
			array_push($array, $title);
			array_push($array, $eventDate);	
			array_push($array, $eventTime);		
			array_push($array, $info);		
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

