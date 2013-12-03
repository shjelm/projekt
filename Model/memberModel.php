<?php

namespace model;

require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';

class memberModel{
	
	CONST EMPTYFORM = 14;
	CONST UNVALIDPNR = 15;
	CONST ADDINGMEMBERSUCCES = 16;
	CONST UNEXISTINGPNR = 17;
	CONST EXISTINGPNR = 18;
	CONST UPDATEDMEMBER = 19;
	CONST DELETEDMEMBER = 22;
	CONST UNVALIDDATEFORMAT = 23;
	CONST UNVALIDCLASS = 32;
	CONST UNVALIDEMAIL = 33;
	
	
	public function __construct(){
		
		$this->checkModel = new \Model\checkModel();;
	}
	
	/**
	 * @return int
	 */
	public function unexistingPnr()
	{
		return self::UNEXISTINGPNR;
	}
	/**
	 * @return int
	 */
	public function alreadyExistingPnr()
	{
		return self::EXISTINGPNR;
	}
	
	/**
	 * @return int
	 */
	public function memberUpdated()
	{
		return self::UPDATEDMEMBER;
	}
	
	/**
	 * @param /model/member
	 * @return int
	 */	
	public function checkUnvalidNewMember(member $member)
	{		
		$paydate = $member->getpayDate();
		$class = $member->getClass();
		$pnr = $member->getPersonalNr();
		$email = $member->getEmail();
			
		if(!empty($paydate) && $this->checkModel->unvalidDateFormat($paydate)){
			return self::UNVALIDDATEFORMAT;
		}
			
		if($this->checkModel->unvalidPersonalnumber($pnr)){
			
			return self::UNVALIDPNR;
		}
		if($this->checkModel->unvalidClass($class)){
			
			return self::UNVALIDCLASS;
		}
		else if($this->checkModel->unvalidEmail($email))
		{
			return self::UNVALIDEMAIL;
		}
		
		for ($i=0; $i < count($member)-1; $i++) { 
			if(empty($member[$i])){
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
		$paydate = $member->getpayDate();
		$class = $member->getClass();
		$pnr = $member->getPersonalNr();
		$email = $member->getEmail();
			

		for ($i=0; $i < count($member)-1; $i++) { 
			if(empty($member[$i])){
				return false;
			}
		} 
		if (!empty($paydate) && $this->checkModel->unvalidDateFormat($paydate)){
			return false;
		}
		else if ($this->checkModel->unvalidPersonalnumber($pnr)){
			return false;
		}
		else if($this->checkModel->unvalidClass($class))
		{
			return false;
		}
		else if($this->checkModel->unvalidEmail($email))
		{
			return false;
		}
		else{
			return true;
		}
	}	
	
	/**
	 * @return int
	 */
	public function memberDeleted()
	{
		return self::DELETEDMEMBER;
	}
}