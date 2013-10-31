<?php 

/**
 * HTMLPage generates the page 
 * */
namespace view;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';

class HTMLPage{
	
	private static $USERNAME = "username";
	private static $PASSWORD = "password";
	private static $REPEATPASSWORD = "repeatPassword";
	private static $REGISTRATE ="addMember";
	private static $BACK = "getBack";	
	private static $NAME = "name";
	private static $PERSONALNR = "personalNr";
	private static $ADDRESS = "address";
	private static $EMAIL = "email";
	private static $PHONENR = "phoneNr";
	private static $CLASS = "class";
	private static $PAYDATE = "payDate";
	private static $UPDATE ="updateMember";
	private static $NEWNAME = "newName";
	private static $NEWPERSONALNR = "newPersonalNr";
	private static $NEWADDRESS = "newAddress";
	private static $NEWEMAIL = "newEmail";
	private static $NEWPHONENR = "newPhoneNr";
	private static $NEWCLASS = "newClass";
	private static $NEWPAYDATE = "newPayDate";
	
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
	 * @return string HTML
	 */	
	private function startOfHTML(){
		return '<!DOCTYPE HTML>
					   <html>
							<head>
								<title> SPIIK </title>
								
								<link rel="Stylesheet" href="bootstrap.css">
								<link href="http://fonts.googleapis.com/css?family=Cutive+Mono|Fredericka+the+Great|Offside|Shadows+Into+Light+Two|Wallpoet" rel="stylesheet" type="text/css">
								<meta charset="UTF-8">
							</head>
							<body>
							<div id="wrapper">
								<div class="page-header" id="header">
									<img id="logga" class="pull-right" src="pics/SPIIK2.png" alt="SPIIK logga"/>
									<h1>Studentföreningen Prima Ingenjörer I Kalmar</h1><h1><small>En av Kalmars äldsta studentföreningar</small></h1>';	
							
	}
	
	/**  
	 * @param string, a message
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
											<label for="AutoLogin">Håll mig inloggad  :
											<input type="checkbox" name="AutoLogin" id="AutoLogin" />	</label>								
									      	<input type="submit" name="login" value="Logga in" />
								    	</form>';
	
		$this->html .= '</fieldset>
				    	</div>'.
						$this->getClock();
	
		echo $this->html;
	}

	/**  
	 * @param string, message
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
								<li><p><a href="?addMember">Registera medlem</a></p></li> 
								<li><p><a href="?showAllMembers">Visa alla medlemmar</a></p></li>
								<li><p><a href="?showMember">Visa medlem</a></p></li>
								</ul>
								<form method="post" action="?logout">
								<input type="submit" name="logout" value="Logga ut" /> 
								</form>
								</div>'.
								$this->getClock();								
		echo $this->html;
	}

	/**  
	 * @param string, message
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
					<p><label for='PasswordID' >Personnummer (Anges på formatet XXXXXXXXX)  :</label>
					<input type='text' size='20' name='" . self::$PERSONALNR . "' id='UserNameID' value='". $pnrValue ."' /></p>
					<p><label for='PasswordID' >Adress  :</label>
					<input type='text' size='20' name='" . self::$ADDRESS . "' id='UserNameID' value='". $addressValue ."' /></p>
					<p><label for='PasswordID' >Epost  :</label>
					<input type='text' size='20' name='" . self::$EMAIL . "' id='UserNameID' value='". $emailValue ."' /></p>
					<p><label for='PasswordID' >Telefonnummer  :</label>
					<input type='text' size='20' name='" . self::$PHONENR . "' id='UserNameID' value='". $phnrValue ."' /></p>
					<p><label for='PasswordID' >Klass (Om passiv medlem skriv ange '-' som klass) :</label>
					<input type='text' size='20' name='" . self::$CLASS . "' id='UserNameID' value='". $classValue ."' /></p>
					<p><label for='PasswordID' >Betalat till  :</label>
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
	 * @return String HTML
	 */
	public function getLoggedInMemberPage($userString, $userInfo)
	{
		//TODO: visa medlemmens uppgifter här
	$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content' >";
		$this->html .= '
				<h2>'.$userString.' är inloggad</h2>
				<p>'.$this->showMembers($userInfo).'</p>
				<p><a href="?showAllMembersSimple">Visa alla medlemmar</a></p>
				<form method="post" action="?logout">
				<input type="submit" name="logout" value="Logga ut" /> 
				</form>
			</div>'.
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
	 * @return String HTML
	 */
	public function getShowMembersPage($members)
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
	 * @param array
	 * @return String HTML
	 */
	public function getShowMemberPage($messagestring,$member)
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
			<p><a href='?updateMember'>Ändra medlem</a></p>
			</div>".
			$this->getClock();
			
		echo $this->html;
	}
	
	public function getUpdateMemberPage($messagestring, $member)
	{
		$this->html = $this->startOfHTML();
		$this->html .="</div>
					   <div id='content'>". $this->getBack();
		$this->html .= "
			<h2>Personnummer : ".$member."</h2>
			<form class='form-horizontal' action='?" . self::$UPDATE. "' method='post' enctype='multipart/form-data'>
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
					<input type='submit' name='update'  value='Uppdatera' />
				</fieldset>
			</form>
			</div>".
			$this->getClock();
			
		echo $this->html;
		
	}

	/**
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
		setlocale(LC_ALL, "swedish");
		
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