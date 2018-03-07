<?php
namespace WapplerSystems\FormhandlerCleverreach\Formhandler\PreProcessor;

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

use Typoheads\Formhandler\PreProcessor\AbstractPreProcessor;

/**
 * @author	Sven Wappler <typo3YYYY@wappler.systems>
 */
class CleverReach extends AbstractPreProcessor
{

    /**
     * The main method called by the controller
     *
     * @return array GP
     */
    public function process()
    {
        if (!class_exists('SoapClient')) {
            $this->utilityFuncs->throwException('SoapClient not available! Please install the php extension.');
        }

        return $this->gp;
    }
}
