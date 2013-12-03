<?php

namespace view;

class messageView{
	
	/** 
	 * Konstanter för hantering av meddelanden
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
	CONST UNVALIDLENGTHPASSWORD = 31;
	CONST UNVALIDCLASS = 32;
	CONST UNVALIDEMAIL = 33;
	CONST DEFAULTMSG = 999;
	
	/**
	 * @var string
	 */
	private $messageString;
	
	/**
	 * @param int
	 * @return string
	 */
	public function setMessage($messageNr)
	{
		if($_GET){
			switch ($messageNr) {
				
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
					
				case self::UNVALIDLENGTHPASSWORD:
					$this->messageString = '<p class="alert alert-danger">Lösenordet måste vara mellan 6 och 20 tecken långt</p>';	
					break;	
					
				case self::UNVALIDCLASS:
					$this->messageString = '<p class="alert alert-danger">Du måste ange en giltig klass (UDXX,WPXX,ITXX,IDXX)</p>';	
					break;	
					
				case self::UNVALIDEMAIL:
					$this->messageString = '<p class="alert alert-danger">Du måste ange en giltig epost</p>';	
					break;	
					
				default:
					$this->messageString = '';
			}
			return $this->messageString;
		}
	}
}
