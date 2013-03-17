<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}




t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Formhandler Cleverreach API');

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/ContactForm', 'Formhandler Cleverreach Contact Form');

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DoubleOptIn', 'Formhandler Cleverreach DoubleOptIn');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DoubleOptOut', 'Formhandler Cleverreach DoubleOptOut');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/OptIn', 'Formhandler Cleverreach OptIn');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/OptOut', 'Formhandler Cleverreach OptOut');



?>