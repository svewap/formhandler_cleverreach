<?php
namespace WapplerSystems\FormhandlerCleverreach\Formhandler\Validator;

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

use Typoheads\Formhandler\Validator\AbstractValidator;
use WapplerSystems\FormhandlerCleverreach\CleverReach\SoapClient;

/**
 * Checks if the email is in cleverreach database
 *
 * @author	Sven Wappler <typo3YYYY@wappler.systems>
 */
abstract class CleverReachEmail extends AbstractValidator {

	protected $subscriber_found = FALSE;
	
	protected $subscriber_active = FALSE;



	public function check() {
		$checkFailed = '';
		
		$soap = new SoapClient($this->settings['wsdlUrl']);

        $formFieldName = $this->settings['field'];
		
		$return = $soap->receiverGetByEmail($this->settings['apiKey'], $this->settings['listId'], trim($this->gp[$formFieldName]),0);

        $this->utilityFuncs->debugMessage('cleverreach return values: '.print_r($return,true));

        if ($return->statuscode == 1) return "apikey";
		
		$this->subscriber_active = ($return->data->active != 0);
		
		$this->subscriber_found = ($return->status == \WapplerSystems\FormhandlerCleverreach\Formhandler\Finisher\CleverReach::STATUS_SUCCESS);
		
		return $checkFailed;
	}


}
?>