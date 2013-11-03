<?php 

/**
 * HTMLPage generates the page 
 * */
namespace view;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';

class HTMLPage{
	
	/**
	 * @var string
	 */
	private static $USERNAME = "username";
	
	/**
	 * @var string
	 */
	private static $PASSWORD = "password";
	
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
	private static $DELETE ="deleteMember";
	
	
	/**
	 * @var string
	 */
	private static $BACK = "getBack";	
	
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
	private static $UPDATE ="updateMember";
	
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
	private static $username = "UserName";
	
	/**
	 * @var string
	 */
	private static $mySession = "mySession";
	
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
		/**
		 * @var string
		 */		 
		$value = null;
	
		if (isset($_POST[self::$username])) {
			$value = $_POST[self::$username];
		}
		
		$this->html = $this->startOfHTML();
		
		$this->html .= '		</div>
							<div id="content">
								<h2>Ej inloggad</h2>
								
								<fieldset>
									<legend>Skriv in användarnamn och lösenord</legend>'.$messageString.'
										<form class="form-horizontal" method="post" action="?login" role="form">
											<label for="UserName">Användarnamn: </label>
											<input type="text" name="UserName" id="UserName" value="' . $value . '">
											<label for="Password">Lösenord: </label>
											<input type="password" name="Password" id="Password" value="">
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
		$this->html .= '	</div>
							<div id="content">	
								<h2> Admin är inloggad </h2>
								' . $messageString . '
								<p>Vad vill du göra nu?</p>
								<ul class="nav nav-pills nav-stacked">
								<li><p><a href="?'.self::$addMember.'">Registera medlem</a></p></li> 
								<li><p><a href="?'.self::$showAllMembers.'">Visa alla medlemmar</a></p></li>
								<li><p><a href="?'.self::$showMember.'">Visa medlem</a></p></li>
								</ul>
								<ul class="nav nav-pills nav-stacked">
								<li><p><a href="?wantsToAddEvent">Skapa evenemang</a></p></li>
								<li><p><a href="?wantsToUpdateEvent">Ändra evenemang</a></p></li>
								<li><p><a href="?showEvents">Visa alla evenemang</a></p></li>
								</ul>
								<form method="post" action="?logout">
								<input type="submit" name="logout" value="Logga ut" /> 
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

		if (isset($_POST[self::$NAME])) {
			$nameValue = $_POST[self::$NAME];
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
					<legend>Registrera ny användare - Skriv in namn och lösenord</legend>".$messagestring."
					<p><label for='UserNameID' >Namn :</label>
					<input type='text' size='20' name='" . self::$NAME . "' id='UserNameID' value='". $nameValue ."' /></p>
					<p><label for='PasswordID' >Personnummer (Anges på formatet ÅÅMMDDXXXX)  :</label>
					<input type='text' size='20' name='" . self::$PERSONALNR . "' id='UserNameID' value='". $pnrValue ."' /></p>
					<p><label for='PasswordID' >Adress  :</label>
					<input type='text' size='20' name='" . self::$ADDRESS . "' id='UserNameID' value='". $addressValue ."' /></p>
					<p><label for='PasswordID' >Epost  :</label>
					<input type='text' size='20' name='" . self::$EMAIL . "' id='UserNameID' value='". $emailValue ."' /></p>
					<p><label for='PasswordID' >Telefonnummer  :</label>
					<input type='text' size='20' name='" . self::$PHONENR . "' id='UserNameID' value='". $phnrValue ."' /></p>
					<p><label for='PasswordID' >Klass (Om passiv medlem skriv ange '-' som klass) :</label>
					<input type='text' size='20' name='" . self::$CLASS . "' id='UserNameID' value='". $classValue ."' /></p>
					<p><label for='PasswordID' >Betalat till (Anges på formatet ÅÅÅÅ-MM-DD) :</label>
					<input type='text' size='20' name='" . self::$PAYDATE . "' id='UserNameID' value='". $paydateValue ."' /></p>
					<input type='submit' name=''  value='Registrera' />
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
				<p>'.$this->showMembers($userInfo).'</p>
				<p><a href="?'.self::$changePassword.'">Ändra lösenord</a></p>
				<p><a href="?'.self::$showAllMembersSimple.'">Visa alla medlemmar</a></p>
				<p><a href="?showEvents">Visa alla evenemang</a></p>
				<form method="post" action="?logout">
				<input type="submit" name="logout" value="Logga ut" /> 
				</form>
			</div>'.
			$this->getClock();
			
		echo $this->html;
	}

	/**  
	 * @param string
	 * @return String HTML
	 */
	public function getShowEventsPage($events)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >". $this->getBack();
		$this->html .= '
				<h2>Evenemang</h2>'.$this->showEvents($events).'
			</div>'.
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

		if (isset($_POST['addEvent'])) {
			$titleValue = $_POST['eventTitle'];
			$dateValue= $_POST['eventDate'];
			$timeValue= $_POST['eventTime'];
			$infoValue= $_POST['eventInfo'];
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
						<input  type='text' size='20' name='eventTitle' id='titleID' value='".$titleValue."' /></p>
						<p><label for='dateID' >Datum (ÅÅÅÅ-MM-DD) :</label>
						<input type='text' size='50' name='eventDate' id='dateID' value='".$dateValue."' /></p>
						<p><label for='timeID' >Tid (HH:MM) :</label>
						<input type='text' size='50' name='eventTime' id='timeID' value='".$timeValue."' /></p>
						<p><label for='infoID' >Beskrivning :</label>
						<textarea size='250' name='eventInfo' id='infoID' value=''>".$infoValue."</textarea></p>
						<input type='submit' name='addEvent'  value='Spara' />
					</fieldset>
				</form>
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
	public function getShowEventPage($messagestring,$event,$clickable)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
		<form class='form-horizontal' action='?searchEvent' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Visa evenemang - Sök på titel</legend>".$messagestring."
					<p><label for='searchTitleID' >Ange titel :</label>
					<input type='text' size='20' name='searchEvent' id='searchTitleID' value='' /></p>
					<input type='submit' name='searchByEvent'  value='Sök' />
				</fieldset>
			</form>
			<p>".$this->showEvents($event)."</p>
			<p><a href='?updateEvent' onclick='return ".$clickable."'>Ändra event</a></p>
			<p><a href='?deleteEvent' onclick='return ".$clickable."'>Radera event</a></p>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	/**
	 * @param string
	 * @param array
	 * @return String HTML
	 */
	public function getUpdateEventPage($messagestring, $event)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Titel : ".$event."</h2>
			<form class='form-horizontal' action='?updateEvent' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Uppdatera event</legend>".$messagestring."
					<p><label for='newDateID' >Datum (ÅÅÅÅ-MM-DD):</label>
					<input type='text' size='20' name='newDate' id='newDateID' value='' /></p>					
					<p><label for='newTimeID' >Tid  (HH:MM):</label>
					<input type='text' size='20' name='newTime' id='newTimeID' value='' /></p>
					<p><label for='newInfoID' >Beskrivning  :</label>
					<input type='text' size='20' name='newInfo' id='newInfoID' value='' /></p>
					<input type='submit' name='updateThisEvent'  value='Uppdatera' />
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
					<input type='submit' name='deleteThisEvent'  value='Radera evenemang' />
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
					<input  type='password' size='20' name='changePasswordField' id='changeID' value='' /></p>
					<p><label for='changeAgainID' >Repetera lösenord :</label>
					<input type='password' size='20' name='repeatPasswordField' id='changeAgainID' value='' /></p>
					<input type='submit' name='changePass'  value='Bekräfta ändring' />
				</fieldset>
			</form>".
			$this->getClock();
			
		echo $this->html;
	}

	/**  
	 * @param array
	 * @return string
	 */
	public function showMembers($members)
	{			
		for ($i=0; $i < count($members); $i++) {
			$this->membersToShow .= $members[$i]."<br>";
		} 		
		
		return $this->membersToShow;
	}
	
	/**  
	 * @param array
	 * @return string
	 */
	public function showEvents($events)
	{			
		for ($i=0; $i < count($events); $i++) {
			$this->eventsToShow .= $events[$i]."<br>";
		} 		
		
		return $this->eventsToShow;
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
			<p><a href='?payingMembers'>Visa betalande medlemmar </a><a href='?notPayingMembers'> Visa icke betalande medlemmar </a><a href='?".self::$showAllMembers."'> Visa alla medlemmar</a></p>".
			"<p>Totalt antal medlemmar i registret: ".$nr."</p>".
				$this->showMembers($members)."
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
				$this->showMembers($members)."
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
	public function getShowMemberPage($messagestring,$member,$clickable)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
		<form class='form-horizontal' action='?searchMember' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Visa en medlem - Sök på personnummer</legend>".$messagestring."
					<p><label for='searchID' >Ange personnummer :</label>
					<input type='text' size='20' name='searchMember' id='searchID' value='' /></p>
					<input type='submit' name=''  value='Sök' />
				</fieldset>
			</form>
			<p>".$this->showMembers($member)."</p>
			<p><a href='?updateMember' onclick='return ".$clickable."'>Ändra medlem</a></p>
			<p><a href='?deleteMember' onclick='return ".$clickable."'>Radera medlem</a></p>
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
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$member."</h2>
			<form class='form-horizontal' action='?".self::$UPDATE."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Uppdatera medlem</legend>".$messagestring."
					<p><label for='UserNameID' >Namn :</label>
					<input type='text' size='20' name='" . self::$NEWNAME . "' id='UserNameID' value='". $value ."' /></p>					
					<p><label for='PasswordID' >Adress  :</label>
					<input type='text' size='20' name='" . self::$NEWADDRESS . "' id='UserNameID' value='". $value ."' /></p>
					<p><label for='PasswordID' >Epost  :</label>
					<input type='text' size='20' name='" . self::$NEWEMAIL . "' id='UserNameID' value='". $value ."' /></p>
					<p><label for='PasswordID' >Telefonnummer  :</label>
					<input type='text' size='20' name='" . self::$NEWPHONENR . "' id='UserNameID' value='". $value ."' /></p>
					<p><label for='PasswordID' >Klass  :</label>
					<input type='text' size='20' name='" . self::$NEWCLASS . "' id='UserNameID' value='". $value ."' /></p>
					<p><label for='PasswordID' >Betalat till  :</label>
					<input type='text' size='20' name='" . self::$NEWPAYDATE . "' id='UserNameID' value='". $value ."' /></p>
					<input type='submit' name='updateThisMember'  value='Uppdatera' />
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
	public function getDeleteMemberPage($messagestring, $member)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$member."</h2>
			<form class='form-horizontal' action='?" . self::$DELETE. "' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Radera medlem</legend>".$messagestring."
					<input type='submit' name='deleteThisMember'  value='Radera medlem' />
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
				
		setcookie("username", "",time()-3600);
		setcookie("password", "",time()-3600);
	
		$this->getPage($messageString);
		exit;
	}
	
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