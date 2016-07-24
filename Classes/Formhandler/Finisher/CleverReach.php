<?php
namespace WapplerSystems\FormhandlerCleverreach\Formhandler\Finisher;

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

use Typoheads\Formhandler\Finisher\AbstractFinisher;

/**
 *
 * @author	Sven Wappler <typo3YYYY@wappler.systems>
 */
class CleverReach extends AbstractFinisher {
	
	const STATUS_SUCCESS = "SUCCESS";

	/**
	 * The main method called by the controller
	 *
	 * @return array The probably modified GET/POST parameters
	 */
	public function process() {


		return $this->gp;
	}

	/*
	 * Converting the formhandler array into in array which the cleverreach api understands
	 * 
	 */
	protected function convertAttributes($formdata) {
		$attributes = array();
		
		foreach ($formdata as $key => $val) {
			$attributes[] = array('key' => str_replace(" ","_",strtolower($key)), 'value' => $val);
		}
		
		return $attributes;
	}


	/**
	 * Parses mapping settings and builds an array holding the query fields information.
	 *
	 * @return array The query fields
	 */
	protected function parseFields($key = "fields.") {
		$queryFields = array();
		if (!is_array($this->settings[$key])) return $queryFields;

		//parse mapping
		foreach ($this->settings[$key] as $fieldname => $options) {
			$fieldname = str_replace('.', '', $fieldname);
            $fieldValue = null;
			if (isset($options) && is_array($options)) {
				if(!isset($options['special'])) {
					$mapping = $options['mapping'];

					//if no mapping default to the name of the form field
					if (!$mapping) {
						$mapping = $fieldname;
					}

					$fieldValue = $this->gp[$mapping];

					//pre process the field value. e.g. to format a date
					if (isset($options['preProcessing.']) && is_array($options['preProcessing.'])) {
						$options['preProcessing.']['value'] = $fieldValue;
						$fieldValue = $this->utilityFuncs->getSingle($options, 'preProcessing');
					}

					if (isset($options['mapping.']) && is_array($options['mapping.'])) {
						$options['mapping.']['value'] = $fieldValue;
						$fieldValue = $this->utilityFuncs->getSingle($options, 'mapping');
					}

					//process empty value handling
					if ($options['ifIsEmpty'] && strlen($fieldValue) == 0) {
						$fieldValue = $this->utilityFuncs->getSingle($options, 'ifIsEmpty');
					}

					if ($options['zeroIfEmpty'] && strlen($fieldValue) == 0) {
						$fieldValue = 0;
					}

					//process array handling
					if (is_array($fieldValue)) {
						$separator = ',';
						if ($options['separator']) {
							$separator = $options['separator'];
						}
						$fieldValue = implode($separator, $fieldValue);
					}


				}
			} else {
				$fieldValue = $options;
			}


			$queryFields[$fieldname] = $fieldValue;

			if ($options['nullIfEmpty'] && strlen($queryFields[$fieldname]) == 0) {
				unset($queryFields[$fieldname]);
			}
		}
		return $queryFields;
	}




	/**
	 * Fetches the global TypoScript settings of the Formhandler
	 *
	 * @return array
	 */
	protected function getSettings() {
		return $this->configuration->getSettings();
	}


}
