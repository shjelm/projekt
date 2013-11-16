<?php

namespace model;

class checkModel{
	
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
		preg_match('/^([0-2]{1}[0-9]{1}):([0-5]{1}[0-9]{1})$/', $time, $matches);
		$valid = count($matches);
		if($valid == 3){
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
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
}
