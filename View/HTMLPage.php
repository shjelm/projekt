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
	 * @return string HTML
	 */	
	private function startOfHTML(){
		return '<!DOCTYPE HTML>
					   <html>
							<head>
								<title> SPIIK </title>
								<link rel="Stylesheet" href="basic.css">
								<link href="http://fonts.googleapis.com/css?family=Cutive+Mono|Fredericka+the+Great|Offside|Shadows+Into+Light+Two|Wallpoet" rel="stylesheet" type="text/css">
								<meta charset="UTF-8">
							</head>
							<body>
							<div id="wrapper">
								<div id="header">
									<img id="logga" src="pics/SPIIK2.png" alt="SPIIK logga"/>
									<h1>Studentföreningen Prima Ingenjörer I Kalmar</h1>';	
							
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
									<legend>Skriv in användarnamn och lösenord</legend>
										<form method="post" action="?login">
											<label for="UserName">Användarnamn: </label>
											<input type="text" name="UserName" id="UserName" value="' . $value . '">
											<label for="Password">Lösenord: </label>
											<input type="password" name="Password" id="Password" value="">
											<label for="AutoLogin">Håll mig inloggad  :</label>
											<input type="checkbox" name="AutoLogin" id="AutoLogin" />									
									      	<input type="submit" name="login" value="Logga in" />
								    	</form>';
	
		$this->html .= $messageString;
	
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
								<p><a href="?addMember">Registera medlem</a></p> 
								<p><a href="?showMember">Visa medlem</a></p>
								<form method="post" action="?logout">
								<input type="submit" name="logout" value="Logga ut" /> 
								</form>
								</div>'.
								$this->getClock();								
		echo $this->html;
	}

	public function getAddMemberPage()
		{
			$value = null;
	
			if (isset($_POST[self::$USERNAME])) {
				$value = $_POST[self::$USERNAME];
			}
			$this->html = $this->startOfHTML();
			$this->html .="</div>
						   <div id='content'>". $this->getBack();
			$this->html .= "
					<form action='?" . self::$REGISTRATE. "' method='post' enctype='multipart/form-data'>
					<fieldset>
						<legend>Registrera ny användare - Skriv in namn och lösenord</legend>
						<p><label for='UserNameID' >Namn :</label>
						<input type='text' size='20' name='" . self::$USERNAME . "' id='UserNameID' value='". $value ."' /></p>
						<p><label for='PasswordID' >Lösenord  :</label>
						<input type='password' size='20' name='" . self::$PASSWORD . "' id='PasswordID' value='' /></p>
						<p><label for='PasswordID' >Repetera lösenord  :</label>
						<input type='password' size='20' name='" . self::$REPEATPASSWORD . "' id='SecondPasswordID' value='' /></p>
						<input type='submit' name=''  value='Registrera' />
					</fieldset>
				</form>
				</div>".
				$this->getClock();
				
			echo $this->html;
		}

	public function getShowMemberPage()
		{
			$this->html = $this->startOfHTML();
			$this->html .="</div>
						   <div id='content'>". $this->getBack();
			$this->html .= "
					<p>Här ska alla medlemmar visas</p>
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
	
	public function getBack()
	{
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