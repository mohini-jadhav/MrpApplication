<?php
class RegisterPage extends RunnerPage
{
	public $pwdStrong = false;

	function RegisterPage(&$params = "")
	{
		parent::RunnerPage($params);

		// fill global password settings
		$this->pwdStrong = GetGlobalData("pwdStrong", false);
		if($this->pwdStrong)
		{
			$this->settingsMap["globalSettings"]["pwdLen"] = GetGlobalData("pwdLen", 0);
			$this->settingsMap["globalSettings"]["pwdUnique"] = GetGlobalData("pwdUnique", 0);
			$this->settingsMap["globalSettings"]["pwdDigits"] = GetGlobalData("pwdDigits", 0);
			$this->settingsMap["globalSettings"]["pwdStrong"] = true;
			$this->settingsMap["globalSettings"]["pwdUpperLower"] = GetGlobalData("pwdUpperLower", false);
		}

		$this->formBricks["header"] = "regheader";
		$this->formBricks["footer"] = "regbuttons";
		$this->assignFormFooterAndHeaderBricks( true );
	}

	/**
	 * Set the connection property
	 */
	protected function setTableConnection()
	{
		global $cman;
		$this->connection = $cman->getForLogin();
	}

	/**
	 * Check is captcha exists on current page
	 *
	 * @intellisense
	 */
	function captchaExists()
	{
		$captchaSettings = GetGlobalData("CaptchaSettings", false);
		return $captchaSettings["isEnabledOnRegister"];
	}

	function getCaptchaId() {
		return "register";
	}

	/**
	 *
	 */
	public function setDatabaseError( $message )
	{
		//global $strMessage;
		$message = $messageText;
	}

	function isMultistepped()
	{
		return $this->pSet->isRegisterMultistep();
	}
}
?>