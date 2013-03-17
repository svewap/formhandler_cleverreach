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
class Tx_Formhandler_Finisher_CleverReach extends Tx_Formhandler_AbstractFinisher {
	
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

					//process uploaded files
					$files = $this->globals->getSession()->get('files');
					if (isset($files[$fieldname]) && is_array($files[$fieldname])) {
						$fieldValue = $this->getFileList($files, $fieldname);
					}
				} else {
					switch ($options['special']) {
						case 'sub_datetime':
							$dateFormat = 'Y-m-d H:i:s';
							if($options['special.']['dateFormat']) {
								$dateFormat = $this->utilityFuncs->getSingle($options['special.'], 'dateFormat');
							}
							$fieldValue = date($dateFormat, time());
							break;
						case 'sub_tstamp':
							$fieldValue = time();
							break;
						case 'ip':
							$fieldValue = t3lib_div::getIndpEnv('REMOTE_ADDR');
							break;
						case 'inserted_uid':
							$table = $options['special.']['table'];
							if (is_array($this->gp['saveDB'])) {
								foreach ($this->gp['saveDB'] as $idx => $info) {
									if ($info['table'] === $table) {
										$fieldValue = $info['uid'];
									}
								}
							}
							break;
					}
				}
			} else {
				$fieldValue = $options;
			}

			//post process the field value after formhandler did it's magic.
			if (is_array($options['postProcessing.'])) {
				$options['postProcessing.']['value'] = $fieldValue;
				$fieldValue = $this->utilityFuncs->getSingle($options, 'postProcessing');
			}

			$queryFields[$fieldname] = $fieldValue;

			if ($options['nullIfEmpty'] && strlen($queryFields[$fieldname]) == 0) {
				unset($queryFields[$fieldname]);
			}
		}
		return $queryFields;
	}

	/**
	 * Explodes the given list seperated by $sep. Substitutes
	 * values with according value in GET/POST, if set.
	 *
	 * @param string $list
	 * @param string $sep
	 * @return array
	 */
	private function explodeList($list,$sep = ',') {
		$items = t3lib_div::trimExplode($sep,$list);
		$splitArray = array();
		foreach ($items as $idx => $item) {
			if (isset($this->gp[$item])) {
				array_push($splitArray,$this->gp[$item]);
			} else {
				array_push($splitArray,$item);
			}
		}
		return $splitArray;
	}

	/**
	 * Substitutes values with according value in GET/POST, if
	 * set.
	 *
	 * @param string $value
	 * @return string
	 */
	private function parseSettingValue($value) {
		if (isset($this->gp[$value])) {
			$parsed = $this->gp[$value];
		} else {
			$parsed = $value;
		}
		return $parsed;
	}

	/**
	 * Parses a setting in TypoScript and overrides it with
	 * setting in plugin record if set.
	 * The settings contains a single value or a TS object.
	 *
	 * @param array $settings The settings array containing the
	 * mail settings
	 * @param string $type admin|user
	 * @param string $key The key to parse in the settings array
	 * @return string
	 */
	private function parseValue($settings,$type,$key) {
		if (isset($this->emailSettings[$type][$key])) {
			$parsed = $this->parseSettingValue($this->emailSettings[$type][$key]);
		} else if (isset($settings[$key.'.']) && is_array($settings[$key.'.'])) {
			$settings[$key.'.']['gp'] = $this->gp;
			$parsed = $this->utilityFuncs->getSingle($settings,$key);
		} else {
			$parsed = $this->parseSettingValue($settings[$key]);
		}
		return $parsed;
	}

	/**
	 * Parses a setting in TypoScript and overrides it with
	 * setting in plugin record if set.
	 * The settings contains a list of values or a TS object.
	 *
	 * @param array $settings The settings array containing the
	 * mail settings
	 * @param string $type admin|user
	 * @param string $key The key to parse in the settings array
	 * @return string|array
	 */
	private function parseList($settings,$type,$key) {
		if (isset($this->emailSettings[$type][$key])) {
			$parsed = $this->explodeList($this->emailSettings[$type][$key]);
		} elseif (isset($settings[$key.'.']) && is_array($settings[$key.'.'])) {
			$parsed = $this->utilityFuncs->getSingle($settings,$key);
		} else {
			$parsed = $this->explodeList($settings[$key]);
		}
		return $parsed;
	}

	/**
	 * Parses a list of file names or field names set in
	 * TypoScript and overrides it with setting in plugin record
	 * if set.
	 *
	 * @param array $settings The settings array containing the
	 * mail settings
	 * @param string $type admin|user
	 * @param string $key The key to parse in the settings array
	 * @return string
	 */
	private function parseFilesList($settings,$type,$key) {
		if (isset($settings[$key.'.']) && is_array($settings[$key.'.'])) {
			$parsed = $this->utilityFuncs->getSingle($settings,$key);
			$parsed = t3lib_div::trimExplode(',',$parsed);
		} elseif ($settings[$key]) {
			$files = t3lib_div::trimExplode(',',$settings[$key]);
			$parsed = array();
			$sessionFiles = Tx_Formhandler_Globals::$session->get('files');
			foreach ($files as $idx => $file) {
				if (isset($sessionFiles[$file])) {
					foreach ($sessionFiles[$file] as $subIdx => $uploadedFile) {
						array_push($parsed,$uploadedFile['uploaded_path'].$uploadedFile['uploaded_name']);
					}
				} else {
					array_push($parsed,$file);
				}
			}
		}
		return $parsed;
	}

	/**
	 * Substitutes markers like ###LLL:langKey### in given
	 * TypoScript settings array.
	 *
	 * @param array &$settings The E-Mail settings
	 * @return void
	 */
	protected function fillLangMarkersInSettings(&$settings) {
		foreach ($settings as &$value) {
			if (isset($value) && is_array($value)) {
				$this->fillLangMarkersInSettings($value);
			} else {
				$langMarkers = $this->utilityFuncs->getFilledLangMarkers($value,$this->langFile);
				if (!empty($langMarkers)) {
					$value = $this->cObj->substituteMarkerArray($value,$langMarkers);
				}
			}
		}
	}

	/**
	 * Fetches the global TypoScript settings of the Formhandler
	 *
	 * @return void
	 */
	protected function getSettings() {
		return $this->configuration->getSettings();
	}

	/**
	 * Method to set GET/POST for this class and load the
	 * configuration
	 *
	 * @param array The GET/POST values
	 * @param array The TypoScript configuration
	 * @return void
	 */
	public function init($gp,$settings) {
		parent::init($gp,$settings);
	}

}
