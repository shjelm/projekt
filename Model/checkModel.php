<?php

namespace model;

class checkModel{
	
	CONST UNVALIDDATEFORMAT = 23;
	CONST UNVALIDTIMEFORMAT = 25;
	
	/**
	 * @var string
	 */
	private static $emptyDate = "0000-00-00";
	
	/**
	 * @param string
	 * @return bool
	 */
	public function checkValidDateForUpdate($date)
	{
		if ($date == self::$emptyDate){
			
			return true;
		}
		else if($this->unvalidDateFormat($date))
		{
			return false;
		}		
		else{
			return true;
		}
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function checkValidTimeForUpdate($time)
	{
		if(empty($time) || $this->unvalidTimeFormat($time))
		{
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidDateFormat($date)
	{
		preg_match('/^([1-2]{1}[0-9]{3})-([0-1]{1}[0-9]{1})-([0-2]{1}[0-9]{1})$/', $date, $matches);
		$valid = count($matches);
		if($valid == 4){
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidTimeFormat($time)
	{
		preg_match('/^([0-2]{1}[0-9]{1}):([0-5]{1}[0-9]{1}:([0-5]{1}[0-9]{1}))$/', $time, $matches);
		$valid = count($matches);
		if($valid == 4){
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidPersonalnumber($pnr)
	{
		preg_match('/^[0-9]{10}$/', $pnr, $matches);
		$valid = count($matches);
		if($valid == 1){
			return false;
		}
		else{
			return true;
		}		
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidLengthPassword($password)
	{
		if(strlen($password) >= 21 || strlen($password) <= 7){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidClass($class)
	{
		preg_match('/^[-]{1}$/', $class, $matches);
		
		$isPassive = count($matches); 
		if($isPassive == 1){
			return false;
		}
		else
		{
			preg_match('/^[WP|wp|Wp|UD|ud|Ud|IT|it|It|ID|id|Id]{2}[0-1]{1}[0-9]{1}$/', $class, $matches);
			
			$valid = count($matches);
			
			if($valid == 1){
				return false;
			}
			else{
				return true;
			}	
		}	
	}
		
	/**
	 * @param string
	 * @return bool
	 */
	public function unvalidEmail($email)
	{
		preg_match(
		'/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', 
		$email, $matches);
		$valid = count($matches);
		if($valid == 8){
			return false;
		}
		else{
			return true;
		}		
	}
	
	/**
	 * @return int
	 */
	public function updatedDateFail()
	{
		return self::UNVALIDDATEFORMAT;
	}	
	
	/**
	 * @return int
	 */
	public function updatedTimeFail()
	{
		return self::UNVALIDTIMEFORMAT;
	}
}
