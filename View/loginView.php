<?php

namespace view;

class loginView{

	/**
	 * @var string
	 */
	private static $username = "UserName";
	
	/**
	 * @var string
	 */
	private static $password = "Password";
	
	/**
	 * @var string
	 */
	private static $logOut = "logout";
	
	/**
	 * @var string
	 */
	private static $changePasswordField = "changePasswordField";
	
	/**
	 * @var string
	 */
	private static $repeatPasswordField = "repeatPasswordField";
	
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
	private static $changePassword = "changePassword";
	
	/**
	 * @var string
	 */
	private static $changePass = "changePass";
	
	/**
	 * @return string
	 */
	public function getUsername(){
		if($_POST || $_GET){
			if(isset($_POST[self::$username])){
				$username = strip_tags($_POST[self::$username]);
				return $username;
			}
		}
	}	
	
	/**
	 * @return bool
	 */
	public function isUpdatingDate()
	{
		if (!empty($_POST[self::$newDate])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingTime()
	{
		if (!empty($_POST[self::$newTime])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isShowingChangingPassword()
	{
		if (isset($_GET[self::$changePassword])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return bool
	 */
	public function isChangingPassword()
	{
		if (isset($_POST[self::$changePass])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return string
	 */
	public function getPassword()
	{
		if($_POST || $_GET){
			if(isset($_POST[self::$password])){	
				$password = strip_tags($_POST[self::$password]);	
				return md5($password."crypt");
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function getNewPasswordUncrypted()
	{
		if($_POST || $_GET){
			if(isset($_POST[self::$changePasswordField])){	
				$password = strip_tags($_POST[self::$changePasswordField]);	
				return $password;
			}
		}
	}
	
	/**
	 * @param string
	 * @return string
	 */
	public function encryptPassword($pass)
	{
		if($pass != NULL){
			return md5($pass."crypt");
		}
	}
	
	/**
	 * @return string
	 */
	public function getRepeatedNewPassword()
	{
		if($_POST || $_GET){
			if(isset($_POST[self::$repeatPasswordField])){	
				$password = strip_tags($_POST[self::$repeatPasswordField]);	
				return md5($password."crypt");
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function getDate()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newDate])){
				return $_POST[self::$newDate];
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getTime()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newTime])){
				return $_POST[self::$newTime];
			}
		}				
	}
	
	/**
	 * @return bool
	 */	
	public function checkFormSent()
	{
		if($_POST){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function checkLogout(){
		if($_POST){
			if (isset($_GET[self::$logOut])){
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
}
