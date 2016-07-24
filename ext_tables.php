<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}




\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Formhandler Cleverreach API');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/ContactForm', 'Formhandler Cleverreach Contact Form');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DoubleOptIn', 'Formhandler Cleverreach DoubleOptIn');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DoubleOptOut', 'Formhandler Cleverreach DoubleOptOut');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/OptIn', 'Formhandler Cleverreach OptIn');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/OptOut', 'Formhandler Cleverreach OptOut');



?>