<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Sven Wappler <typo3@wapplersystems.de>, WapplerSystems
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

/**
 *
 * @author	Sven Wappler <typo3@wapplersystems.de>
 * @package	Tx_Formhandler
 * @subpackage	Finisher
 */
class Tx_Formhandler_PreProcessor_CleverReach extends Tx_Formhandler_AbstractPreProcessor {

	/**
	 * The main method called by the controller
	 *
	 * @return Array GP
	 */
	public function process() {
		
		if (!class_exists('SoapClient')) {
			$this->utilityFuncs->throwException('SoapClient not available! Please install the php extension.');
		}

		return $this->gp;
	}



}
