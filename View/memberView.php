<?php

namespace view;

class memberView{
		
	/**
	 * @var string
	 */
	private static $FIRSTNAME = "firstName";
	
	/**
	 * @var string
	 */
	private static $LASTNAME = "lastName";
	
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
	private static $deleteThisMember = "deleteThisMember";
	
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
	private static $NEWFIRSTNAME = "newFirstName";
	
	/**
	 * @var string
	 */
	private static $NEWLASTNAME = "newLastName";
	
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
	private static $updateMember = "updateMember";
	
	/**
	 * @var string
	 */
	private static $deleteMember = "deleteMember";
	
	/**
	 * @var string
	 */
	private static $showAllMembersSimple = "showAllMembersSimple";
	
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
	 * @return array
	 */
	public function getMemberData()
	{
		if($_POST){
			$firstName = $_POST[self::$FIRSTNAME];
			$lastName = $_POST[self::$LASTNAME];
			$personalnr = $_POST[self::$PERSONALNR];
			$address = $_POST[self::$ADDRESS];
			$email = $_POST[self::$EMAIL];
			$phonenr = $_POST[self::$PHONENR];
			$class = $_POST[self::$CLASS];
			$paydate = $_POST[self::$PAYDATE];
			
			$array = array();
			
			array_push($array, strip_tags($firstName));
			array_push($array, strip_tags($lastName));
			array_push($array, $personalnr);		
			array_push($array, strip_tags($class));			
			array_push($array, strip_tags($phonenr));
			array_push($array, strip_tags($email));
			array_push($array, strip_tags($address));
			array_push($array, $paydate);
		
		}
		return $array;
	}
		
	/**
	 * @return string
	 */
	public function getFirstName()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWFIRSTNAME])){
				return strip_tags($_POST[self::$NEWFIRSTNAME]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getLastName()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWLASTNAME])){
				return strip_tags($_POST[self::$NEWLASTNAME]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getAddress()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWADDRESS])){
				return strip_tags($_POST[self::$NEWADDRESS]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getEmail()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWEMAIL])){
				return strip_tags($_POST[self::$NEWEMAIL]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getPhonenr()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWPHONENR])){
				return strip_tags($_POST[self::$NEWPHONENR]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getClass()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$NEWCLASS])){
				return strip_tags($_POST[self::$NEWCLASS]);
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
	 * @return bool
	 */
	public function isUpdatingFirstName()
	{
		if (!empty($_POST[self::$NEWFIRSTNAME])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingLastName()
	{
		if (!empty($_POST[self::$NEWLASTNAME])) {
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
	 * @return string
	 */
	public function getMemberAdminWantsToUpdate(){
		if(isset($_GET[self::$updateMember])){
			$unique = $_GET[self::$updateMember];
			return $unique;
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
	public function getMemberAdminWantsToDelete()
	{
		if(isset($_GET[self::$deleteMember])){
			$unique = $_GET[self::$deleteMember];
			return $unique;
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
		if (isset($_GET[self::$deleteMember])) {
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
		if (isset($_POST[self::$deleteThisMember])) {
			return true;
		}
		else{
			return false;
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
	 * @param array
	 * @return string
	 */
	public function showMembers($members)
	{
		if($members != NULL){
			for ($i=0; $i < count($members); $i++) {
				$this->membersToShow .= $this->getMemberHTML($members[$i]);
			} 		
			
			return $this->membersToShow;
		}
	}	
	
	public function showSimpleMembers($members)
	{
		if($members != NULL){
			for ($i=0; $i < count($members); $i++) {
				$this->membersToShow .= $this->getSimpleMemberHTML($members[$i]);
			} 		
			
			return $this->membersToShow;
		}
	}
	
	/**  
	 * @param array
	 * @return string
	 */
	public function showMemberForMembers($members)
	{
		if($members != NULL){
			for ($i=0; $i < count($members); $i++) {
				$this->membersToShow .= $this->getMemberHTMLForMembers($members[$i]);
			} 		
			
			return $this->membersToShow;
		}
	}
	
	/**
	 * @param model\member
	 * @return string HTML
	 */
	public function getMemberHTML(\model\member $member)
	{
		 $firstName = $member->getFirstName();
		 $lastName= $member->getLastName();
		 $personalnr= $member->getPersonalNr();
		 $class= $member->getClass();
		 $phonenr= $member->getPhoneNr();
		 $email= $member->getEmail();
		 $address= $member->getAddres();
		 $paydate= $member->getPayDate();	
		 $pnr = $member->getPersonalNr();
		 
		 $memberHTML = "<div id='member'>
			 				<p>Personnummer: ".$personalnr."
			 				<p>Namn: ".$firstName." ".$lastName."</p>
			 				<p>Klass: ".$class."</p>
			 				<p>Telefonnummer: ".$phonenr."</p>
			 				<p>Emailadress: ".$email."</p>
			 				<p>Adress: ".$address."</p>
			 				<p>Betalat till: ".$paydate."</p>
			 				<p><a href='?".self::$updateMember."=".$pnr."'>Ändra medlem</a></p>
							<p><a href='?".self::$deleteMember."=".$pnr."'>Radera medlem</a></p>
			 				<br>
		 				</div>";
						
		return $memberHTML;					
	}
	
	/**
	 * @param model\member
	 * @return string HTML
	 */
	public function getSimpleMemberHTML(\model\simpleMember $simpleMember)
	{
		 $firstName = $simpleMember->getFirstName();
		 $lastName= $simpleMember->getLastName();
		 $class= $simpleMember->getClass();
		 $email= $simpleMember->getEmail();	
		 
		 $memberHTML = "<div id='member'>
			 				<p>Namn: ".$firstName." ".$lastName."</p>
			 				<p>Klass: ".$class."</p>
			 				<p>Emailadress: ".$email."</p>
			 				<br>
		 				</div>";
						
		return $memberHTML;					
	}
	
	public function getMemberHTMLForMembers($member)
	{
		 $firstName = $member->getFirstName();
		 $lastName= $member->getLastName();
		 $personalnr= $member->getPersonalNr();
		 $class= $member->getClass();
		 $phonenr= $member->getPhoneNr();
		 $email= $member->getEmail();
		 $address= $member->getAddres();
		 $paydate= $member->getPayDate();	
		 $pnr = $member->getPersonalNr();
		 
		 $memberHTML = "<div id='member'>
			 				<p>Personnummer: ".$personalnr."
			 				<p>Namn: ".$firstName." ".$lastName."</p>
			 				<p>Klass: ".$class."</p>
			 				<p>Telefonnummer: ".$phonenr."</p>
			 				<p>Emailadress: ".$email."</p>
			 				<p>Adress: ".$address."</p>
			 				<p>Betalat till: ".$paydate."</p>
			 				<br>
		 				</div>";
						
		return $memberHTML;					
	}
}