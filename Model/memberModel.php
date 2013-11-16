<?php

namespace model;

require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';

class memberModel{
	
	CONST EMPTYFORM = 14;
	CONST UNVALIDPNR = 15;
	CONST ADDINGMEMBERSUCCES = 16;
	CONST UNVALIDDATEFORMAT = 23;
	
	public function __construct(){
		
		$this->checkModel = new \Model\checkModel();;
	}
	
	/**
	 * @param /model/member
	 * @return array 
	 */	
	public function setMember(member $member)
	{	
		$firstName = $member->getFirstName();
		$lastName = $member->getLastName();
		$pnr = $member ->getPersonalNr();		
		$address = $member->getAddres();
		$phnr = $member->getPhoneNr();
		$email = $member->getEmail();		
		$class = $member->getClass();
		$paydate = $member->getPayDate();
		$username = $member->getUserName();
		
		$setMember = array();
		
		array_push($setMember, $firstName);
		array_push($setMember, $lastName);
		array_push($setMember, $pnr);
		array_push($setMember, $address);
		array_push($setMember, $phnr);
		array_push($setMember, $email);
		array_push($setMember, $class);		
		array_push($setMember, $username);		
		array_push($setMember, $paydate);
		
		return $setMember;		
	}
	
	/**
	 * @param /model/member
	 * @return int
	 */	
	public function checkUnvalidNewMember(member $member)
	{		
		$setMember = $this->setMember($member);
			
		if(!empty($setMember[8]) &&$this->checkModel->unvalidDateFormat($setMember[8])){
			return self::UNVALIDDATEFORMAT;
		}
			
		if($this->checkModel->unvalidPersonalnumber($setMember[2])){
			
			return self::UNVALIDPNR;
		}
		
		for ($i=0; $i < count($setMember)-1; $i++) { 
			if(empty($setMember[$i])){
				return self::EMPTYFORM;
			}
		} 	
		return self::ADDINGMEMBERSUCCES;	
	}
	
	/**
	 * @param /model/member
	 * @return bool
	 */
	public function checkNewMemberValid(member $member)
	{
		$setMember = $this->setMember($member);

		for ($i=0; $i < count($setMember)-1; $i++) { 
			if(empty($setMember[$i])){
				return false;
			}
		} 
		if (!empty($setMember[8]) && $this->checkModel->unvalidDateFormat($setMember[8])){
			return false;
		}
		else if ($this->checkModel->unvalidPersonalnumber($setMember[2])){
			return false;
		}
		else{
			return true;
		}
	}
}