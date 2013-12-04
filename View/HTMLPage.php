<?php 

/**
 * HTMLPage generates the page 
 * */
namespace view;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/memberView.php';
require_once realpath(dirname(__DIR__)).'/View/eventView.php';


class HTMLPage{
	
	/**
	 * @var view/memberView
	 */
	 private static $memberView;
	 
	 /**
	 * @var view/eventView
	 */
	 private static $eventView;
	 
	/**
	 * @var string
	 */
	private static $USERNAME = "UserName";
	
	/**
	 * @var string
	 */
	private static $SAVENEWMEMBER = "saveNewMember";
	
	/**
	 * @var string
	 */
	private static $newInfo = "newInfo";
	
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
	private static $newTitle = "newTitle";
	
	/**
	 * @var string
	 */
	private static $deleteThisMember = "deleteThisMember";
	
	/**
	 * @var string
	 */
	private static $deleteThisEvent = "deleteThisEvent";
	
	/**
	 * @var string
	 */
	private static $updateThisEvent = "updateThisEvent";
	
	/**
	 * @var string
	 */
	private static $updateThisMember = "updateThisMember";
	
	/**
	 * @var string
	 */
	private static $repeatPasswordField = "repeatPasswordField";
	
	/**
	 * @var string
	 */
	private static $changePasswordField = "changePasswordField";
	
	
	/**
	 * @var string
	 */
	private static $searchMember = "searchMember";
	
	/**
	 * @var string
	 */
	private static $PASSWORD = "Password";
	
	/**
	 * @var string
	 */
	private static $LOGOUT = "logout";
	
	/**
	 * @var string
	 */
	private static $REPEATPASSWORD = "repeatPassword";
	
	/**
	 * @var string
	 */
	private static $REGISTRATE ="addMember";
	
	/**
	 * @var string
	 */
	private static $eventDate ="eventDate";
	
	/**
	 * @var string
	 */
	private static $eventTime ="eventTime";
	
	/**
	 * @var string
	 */
	private static $eventInfo ="eventInfo";
	
	/**
	 * @var string
	 */
	private static $eventTitle ="eventTitle";
	
	/**
	 * @var string
	 */
	private static $addEvent ="addEvent";
	
	/**
	 * @var string
	 */
	private static $showEvents ="showEvents";
	
	/**
	 * @var string
	 */
	private static $DELETE ="deleteMember";
	
	
	/**
	 * @var string
	 */
	private static $BACK = "getBack";	
	
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
	private static $UPDATE ="updateMember";
	
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
	 * @var date
	 */
	private static $NEWPAYDATE = "newPayDate";
	
	/**
	 * @var string
	 */
	private static $showAllMembersSimple = "showAllMembersSimple";
	
	/**
	 * @var string
	 */
	private static $showMember = "showMember";
	
	/**
	 * @var string
	 */
	private static $showAllMembers = "showAllMembers";
	
	/**
	 * @var string
	 */
	private static $addMember = "addMember";
	
	/**
	 * @var string
	 */
	private static $changePassword = "changePassword";
	
	/**
	 * @var $string HTML
	 * */
	private $html = "";
	
	/**
	 * @var string
	 */
	private static $mySession = "mySession";
	
	/**
	 * @var string
	 */
	private static $wantsToAddEvent = "wantsToAddEvent";
	
	/**
	 * @var view/LoginView
	 */	
	private $loginView;
	
	/**
	 * @var String 
	 */	
	private $messageString;
	
	/**
	 * @var String 
	 */	
	private $membersToShow;
	
	/**
	 * @var String 
	 */	
	private $eventsToShow;
	
	/**
	 * @var String 
	 */	
	private $simpleEventsToShow;
	
	public function __construct()
	{
		$this->memberView = new \view\memberView();
		$this->eventView = new \view\eventView();
		$this->loginView = new \view\loginView();
	}
	
	/**
	 * @return string HTML
	 */	
	private function startOfHTML(){
		return '<!DOCTYPE HTML>
					   <html>
							<head>
								<title> SPIIK </title>
								
								<link rel="Stylesheet" href="bootstrap.css">
								<link href="http://fonts.googleapis.com/css?family=Cutive+Mono|Fredericka+the+Great|Offside|Shadows+Into+Light+Two|Wallpoet" rel="stylesheet" type="text/css">
								<meta charset="utf-8">
							</head>
							<body>
							<div id="wrapper">
								<div class="page-header" id="header">
									<img id="logga" class="pull-right" src="pics/SPIIK2.png" alt="SPIIK logga"/>
									<h1>Studentföreningen Prima Ingenjörer I Kalmar</h1><h1><small>En av Kalmars äldsta studentföreningar</small></h1>';	
							
	}
	
	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getPage($messageString) {
		 
		$value = $this->loginView->getUserName();
		
		$this->html = $this->startOfHTML();
		
		$this->html .= '		</div>
							<div id="content">
								<h2>Ej inloggad</h2>
								
								<fieldset>
									<legend>Skriv in användarnamn och lösenord</legend>'.$messageString.'
										<form class="form-horizontal" method="post" action="?login" role="form">
											<label for="UserName">Användarnamn: </label>
											<input autofocus type="text" name="'.self::$USERNAME.'" id="UserName" value="' . $value .'">
											<label for="Password">Lösenord: </label>
											<input type="password" name="'.self::$PASSWORD.'" id="Password" value="">
											<p><input type="submit" name="login" value="Logga in" /></p>
										</form>';											    	
	
		$this->html .= '</fieldset>
				    </div>'.
				$this->getClock();
	
		echo $this->html;
	}

	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getLoggedInPage($messageString) {
		$this->html = $this->startOfHTML();
		$this->html .= '</div>
						<div id="content">	
							<h2> Admin är inloggad </h2>
							' . $messageString . '
							<p>Vad vill du göra nu?</p>
							<ul class="nav nav-pills nav-stacked">
								<li><p><a href="?'.self::$addMember.'">Registera medlem</a></p></li> 
								<li><p><a href="?'.self::$showAllMembers.'">Visa alla medlemmar</a></p></li>						
							</ul>
							<ul class="nav nav-pills nav-stacked">
								<li><p><a href="?'.self::$wantsToAddEvent.'">Skapa evenemang</a></p></li>
								
								<li><p><a href="?'.self::$showEvents.'">Visa alla evenemang</a></p></li>
							</ul>
							<form method="post" action="?'.self::$LOGOUT.'">
								<input type="submit" name="'.self::$LOGOUT.'" value="Logga ut" /> 
							</form>
						</div>'.
						$this->getClock();	
		echo $this->html;
	}

	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getAddMemberPage($messagestring)
	{
		$nameValue;
		$pnrValue;
		$addressValue;
		$emailValue;
		$phnrValue;
		$classValue;
		$paydateValue;

		if (isset($_POST)) {
			$firstNameValue = $_POST[self::$FIRSTNAME];
			$lastNameValue = $_POST[self::$LASTNAME];
			$pnrValue= $_POST[self::$PERSONALNR];
			$addressValue= $_POST[self::$ADDRESS];
			$emailValue= $_POST[self::$EMAIL];
			$phnrValue= $_POST[self::$PHONENR];
			$classValue= $_POST[self::$CLASS];
			$paydateValue= $_POST[self::$PAYDATE];
		}
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= "
				<form class='form-horizontal' action='?" . self::$REGISTRATE. "' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Registrera ny användare - Skriv in uppgifter</legend>".$messagestring."
					<p><label for='FirstNameID' >Förnamn :</label>
					<input autofocus type='text' size='20' name='" . self::$FIRSTNAME . "' id='FirstNameID' value='". $firstNameValue ."' /></p>
					<p><label for='LastNameID' >Efternamn :</label>
					<input type='text' size='30' name='" . self::$LASTNAME . "' id='LastNameID' value='". $lastNameValue ."' /></p>
					<p><label for='PnrID' >Personnummer (Anges på formatet ÅÅMMDDXXXX)  :</label>
					<input type='text' size='20' name='" . self::$PERSONALNR . "' id='PnrID' value='". $pnrValue ."' /></p>
					<p><label for='AddressID' >Adress  :</label>
					<input type='text' size='20' name='" . self::$ADDRESS . "' id='AddressID' value='". $addressValue ."' /></p>
					<p><label for='EmailID' >Epost  :</label>
					<input type='text' size='20' name='" . self::$EMAIL . "' id='EmailID' value='". $emailValue ."' /></p>
					<p><label for='PhNrID' >Telefonnummer  :</label>
					<input type='text' size='20' name='" . self::$PHONENR . "' id='PhNrID' value='". $phnrValue ."' /></p>
					<p><label for='ClassID' >Klass (Om passiv medlem skriv ange '-' som klass) :</label>
					<input type='text' size='20' name='" . self::$CLASS . "' id='ClassID' value='". $classValue ."' /></p>
					<p><label for='PaydateID' >Betalat till (Anges på formatet ÅÅÅÅ-MM-DD) :</label>
					<input type='text' size='20' name='" . self::$PAYDATE . "' id='PaydateID' value='". $paydateValue ."' /></p>
					<input type='submit' name='".self::$SAVENEWMEMBER."' value='Registrera' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**  
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getLoggedInMemberPage($userString, $userInfo)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >";
		$this->html .= '
				<h2>'.$userString.' är inloggad</h2>
				<p>'.$this->memberView->showMemberForMembers($userInfo).'</p>
				<p><a href="?'.self::$changePassword.'">Ändra lösenord</a></p>
				<p><a href="?'.self::$showAllMembersSimple.'">Visa alla medlemmar</a></p>
				<p><a href="?'.self::$showEvents.'">Visa alla evenemang</a></p>
				<form method="post" action="?'.self::$LOGOUT.'">
				<input type="submit" name="'.self::$LOGOUT.'" value="Logga ut" /> 
				</form>
			</div>'.
			$this->getClock();
			
		echo $this->html;
	}

	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getShowEventsPage($events, $completedEvents)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= '
				<h2>Kommande evenemang</h2>'.$this->eventView->showEvents($events).'	
				<h2>Genomförda evenemang</h2>'.$this->eventView->showSimpleEvents($completedEvents).'</div>'.
			$this->getClock();
			
		echo $this->html;
	}
	
	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getShowSimpleEventsPage($events, $completedEvents)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= "
				<h2>Kommande evenemang</h2>".$this->eventView->showSimpleEvents($events)."
				<h2>Genomförda evenemang</h2>".$this->eventView->showSimpleEvents($completedEvents)."
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getAddEventPage($messagestring)
	{
		$titleValue;
		$dateValue;
		$timeValue;
		$infoValue;

		if (isset($_POST[self::$addEvent])) {
			$titleValue = $_POST[self::$eventTitle];
			$dateValue= $_POST[self::$eventDate];
			$timeValue= $_POST[self::$eventTime];
			$infoValue= $_POST[self::$eventInfo];
		}
		
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= "
				<h2>Evenemang</h2>
				<form class='form-horizontal' action='?addEvent' method='post' enctype='multipart/form-data'>
					<fieldset>
						<legend>Lägg till evenemang</legend>".$messagestring."
						<p><label for='titleID' >Titel :</label>
						<input autofocus type='text' size='20' name='".self::$eventTitle."' id='titleID' value='".$titleValue."' /></p>
						<p><label for='dateID' >Datum (ÅÅÅÅ-MM-DD) :</label>
						<input type='text' size='50' name='".self::$eventDate."' id='dateID' value='".$dateValue."' /></p>
						<p><label for='timeID' >Tid (HH:MM:SS) :</label>
						<input type='text' size='50' name='".self::$eventTime."' id='timeID' value='".$timeValue."' /></p>
						<p><label for='infoID' >Beskrivning :</label>
						<textarea size='250' name='".self::$eventInfo."' id='infoID' value=''>".$infoValue."</textarea></p>
						<input type='submit' name='".self::$addEvent."'  value='Spara' />
					</fieldset>
				</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getUpdateEventPage($messagestring, $event, $id)
	{
		$title = $event->getTitle();
	 	$eventDate = $event->getEventDate();
		$eventTime = $event->getEventTime();
		$info = $event->getInfo();

		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<form class='form-horizontal' action='?updateEvent=".$title."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Uppdatera event</legend>".$messagestring."
					<p><label for='newDateID' >Titel: </label>
					<input autofocus type='text' size='20' name='".self::$newTitle."' id='newTitleID' value='".$title."' /></p>
					<p><label for='newDateID' >Datum (ÅÅÅÅ-MM-DD):</label>
					<input autofocus type='text' size='20' name='".self::$newDate."' id='newDateID' value='".$eventDate."' /></p>					
					<p><label for='newTimeID' >Tid  (HH:MM::SS):</label>
					<input type='text' size='20' name='".self::$newTime."' id='newTimeID' value='".$eventTime."' /></p>
					<p><label for='newInfoID' >Beskrivning  :</label>
					<textarea size='250' name='".self::$newInfo."' id='newInfoID'>".$info."</textarea></p>
					<input type='submit' name='".self::$updateThisEvent."'  value='Uppdatera' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;		
	}
	
	/**
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getDeleteEventPage($messagestring, $event)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$event."</h2>
			<form class='form-horizontal' action='?deleteEvent' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Radera medlem</legend>".$messagestring."
					<input type='submit' name='".self::$$deleteThisEvent."'  value='Radera evenemang' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}

	/**
	 * @param string
	 * @return String HTML
	 */
	public function getChangePasswordPage($messagestring)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= "
			<form class='form-horizontal' action='?changePassword' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Ändra lösenord</legend>".$messagestring."
					<p><label for='changeID' >Ange nytt lösenord :</label>
					<input autofocus type='password' size='20' name='".self::$changePasswordField."' id='changeID' value='' /></p>
					<p><label for='changeAgainID' >Repetera lösenord :</label>
					<input type='password' size='20' name='".self::$repeatPasswordField."' id='changeAgainID' value='' /></p>
					<input type='submit' name='changePass'  value='Bekräfta ändring' />
				</fieldset>
			</form>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**  
	 * @param int
	 * @param array
	 * @return String HTML
	 */
	public function getShowMembersPage($nr, $members)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<p><a href='?payingMembers'>Visa betalande medlemmar </a><a href='?notPayingMembers'> 
			Visa icke betalande medlemmar </a><a href='?".self::$showAllMembers."'> 
			Visa alla medlemmar</a></p>
			<form class='form-horizontal' action='?".self::$searchMember."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Visa en medlem - Sök på personnummer</legend>
					<p><label for='searchID' >Ange personnummer :</label>
					<input autofocus type='text' size='20' name='".self::$searchMember."' id='searchID' value='' /></p>
					<input type='submit' name=''  value='Sök' />
				</fieldset>
			</form>
			<h2>Medlemmar</h2>
			<p>Totalt antal medlemmar i registret: ".$nr."</p>".
				$this->memberView->showMembers($members)."
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**  
	 * @param array
	 * @return String HTML
	 */
	public function getShowSimpleMembersPage($members)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= 
				$this->memberView->showSimpleMembers($members)."
			</div>".
			$this->getClock();
		echo $this->html;
	}
	
	/**  
	 * @param string  
	 * @param array
	 * @param string
	 * @return String HTML
	 */
	public function getShowMemberPage($messagestring,$member)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "<p><a href='?payingMembers'>Visa betalande medlemmar </a><a href='?notPayingMembers'> 
			Visa icke betalande medlemmar </a><a href='?".self::$showAllMembers."'> 
			Visa alla medlemmar</a></p>
		<form class='form-horizontal' action='?".self::$searchMember."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Visa en medlem - Sök på personnummer</legend>".$messagestring."
					<p><label for='searchID' >Ange personnummer :</label>
					<input autofocus type='text' size='20' name='".self::$searchMember."' id='searchID' value='' /></p>
					<input type='submit' name=''  value='Sök' />
				</fieldset>
			</form>
			<p>".$this->memberView->showMembers($member)."</p>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getUpdateMemberPage($messagestring, $member)
	{
		if($member != NULL){
			$firstName = $member[0]->getFirstName();
		 	$lastName= $member[0]->getLastName();
			$class= $member[0]->getClass();
			$phonenr= $member[0]->getPhoneNr();
			$email= $member[0]->getEmail();
			$address= $member[0]->getAddres();
			$paydate= $member[0]->getPayDate();	
			$pnr = $member[0]->getPersonalNr();
			
			$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$pnr."</h2>
			<form class='form-horizontal' action='?".self::$UPDATE."=".$pnr."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Uppdatera medlem</legend>".$messagestring."
					<p><label for='nFirstNameID' >Förnamn :</label>
					<input autofocus type='text' size='20' name='" . self::$NEWFIRSTNAME . "' id='nFirstNameID' value='". $firstName ."' /></p>
					<p><label for='nLastNameID' >Efternamn :</label>
					<input type='text' size='20' name='" . self::$NEWLASTNAME . "' id='nLastNameID' value='". $lastName ."' /></p>					
					<p><label for='nAdressID' >Adress  :</label>
					<input type='text' size='20' name='" . self::$NEWADDRESS . "' id='nAdressID' value='". $address ."' /></p>
					<p><label for='nEmailID' >Epost  :</label>
					<input type='text' size='20' name='" . self::$NEWEMAIL . "' id='nEmailID' value='". $email ."' /></p>
					<p><label for='nPhNrID' >Telefonnummer  :</label>
					<input type='text' size='20' name='" . self::$NEWPHONENR . "' id='nPhNrID' value='". $phonenr ."' /></p>
					<p><label for='nClassID' >Klass  :</label>
					<input type='text' size='20' name='" . self::$NEWCLASS . "' id='nPhNrID' value='". $class ."' /></p>
					<p><label for='nPaydateID' >Betalat till  :</label>
					<input type='text' size='20' name='" . self::$NEWPAYDATE . "' id='nPaydateID' value='". $paydate ."' /></p>
					<input type='submit' name='".self::$updateThisMember."'  value='Uppdatera' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
		}
		else{
			$this->getLoggedInPage('');
		}
	}
	
	/**
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getDeleteMemberPage($messagestring, $pnr)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$pnr."</h2>
			<form class='form-horizontal' action='?" . self::$DELETE."=".$pnr."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Radera medlem</legend>".$messagestring."
					<input type='submit' name='".self::$deleteThisMember."'  value='Bekräfta' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}

	/**
	 * @param string
	 * @return String HTML
	 */
	public function getLogOutPage($messageString) {
	
		$this->getPage($messageString);
		exit;
	}
	
	/**
	 * @return string
	 */
	public function getBack(){
		
		$regString = "<p><a href='?" . self::$BACK . "'>Tillbaka</a></p>";
		return $regString;
	}
	
	/**  
	 * @return String HTML with time
	 */
	private function getClock() {
		setlocale(LC_ALL, "sv_SE.utf-8");
		
		/**
		 * @var string 
		 */
		$time = strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ');
		return '					<div id="footer">	
										<p class="time">' . $time . '</p>
									</div>
								</div>	
							</body>
						</html>';
	}
}