<?php
namespace WapplerSystems\FormhandlerCleverreach\Formhandler\ErrorCheck;

/***************************************************************
*  Copyright notice
*
*  (c) 2016 Sven Wappler <typo3YYYY@wappler.systems>, WapplerSystems
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


use Typoheads\Formhandler\Validator\ErrorCheck\AbstractErrorCheck;
use WapplerSystems\FormhandlerCleverreach\CleverReach\SoapClient;

/**
 * Checks if the email is in cleverreach database
 *
 * @author	Sven Wappler <typo3YYYY@wappler.systems>
 */
class CleverReachEmail extends AbstractErrorCheck {

	protected $subscriber_found = FALSE;
	
	protected $subscriber_active = FALSE;

	public function check() {
		$checkFailed = '';
		
		$soap = new SoapClient($this->settings['params']['config.']['wsdlUrl']);
		
		$return = $soap->receiverGetByEmail($this->settings['params']['config.']['apiKey'], $this->settings['params']['config.']['listId'], trim($this->gp[$this->formFieldName]),0);
		if ($return->statuscode == 1) return "apikey";
		
		$this->subscriber_active = $return->data->active;
		
		$this->subscriber_found = ($return->status == \WapplerSystems\FormhandlerCleverreach\Formhandler\Finisher\CleverReach::STATUS_SUCCESS);
		
		return $checkFailed;
	}

}
?>