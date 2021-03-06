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

/**
 * @author	Sven Wappler <typo3YYYY@wappler.systems>
 */
class CleverReachEmailOptout extends CleverReachEmail
{
    public function check()
    {
        $checkFailed = parent::check();
        if ($checkFailed != '') {
            return $checkFailed;
        }

        if (!$this->subscriber_found || !$this->subscriber_active) {
            // nicht im System oder inaktiv

            $checkFailed = 'cleverreachemailoptout';
        }

        return $checkFailed;
    }

    public function validate(&$errors)
    {
        $this->utilityFuncs->debugMessage('call cleverreach email optout validator');

        $checkFailed = $this->check();

        $errorFieldName = $this->settings['field'];

        if (strlen($checkFailed) > 0) {
            if (!is_array($errors[$errorFieldName])) {
                $errors[$errorFieldName] = [];
            }
            $errors[$errorFieldName][] = $checkFailed;
        }

        return empty($errors);
    }
}
