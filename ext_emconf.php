<?php

########################################################################
# Extension Manager/Repository config file for ext "formhandler_cleverreach".
#
# Auto generated 10-12-2012 11:23
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Formhandler Cleverreach Newsletter',
	'description' => 'Provides finishers and validators for using the cleverreach API. It comes with many examples and can be directly used without modification.',
	'category' => 'plugin',
	'author' => 'Sven Wappler',
	'author_email' => 'typo3@wapplersystems.de',
	'author_company' => 'WapplerSystems',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.2.6',
	'constraints' => array(
		'depends' => array(
			'formhandler' => '1.0.0-2.9.99',
			'typo3' => '4.5.0-6.2.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:40:{s:12:"ext_icon.gif";s:4:"a9ab";s:14:"ext_tables.php";s:4:"1cf6";s:14:"ext_tables.sql";s:4:"d41d";s:66:"Classes/Formhandler/Tx_Formhandler_ErrorCheck_Cleverreachemail.php";s:4:"53b1";s:71:"Classes/Formhandler/Tx_Formhandler_ErrorCheck_Cleverreachemailoptin.php";s:4:"099f";s:72:"Classes/Formhandler/Tx_Formhandler_ErrorCheck_Cleverreachemailoptout.php";s:4:"5191";s:59:"Classes/Formhandler/Tx_Formhandler_Finisher_CleverReach.php";s:4:"ea7b";s:57:"Classes/Formhandler/Tx_Formhandler_Finisher_Subscribe.php";s:4:"67fb";s:59:"Classes/Formhandler/Tx_Formhandler_Finisher_Unsubscribe.php";s:4:"8eff";s:63:"Classes/Formhandler/Tx_Formhandler_PreProcessor_CleverReach.php";s:4:"ba85";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"7f8f";s:38:"Configuration/TypoScript/constants.txt";s:4:"8488";s:34:"Configuration/TypoScript/setup.txt";s:4:"c4c4";s:50:"Configuration/TypoScript/ContactForm/constants.txt";s:4:"9403";s:46:"Configuration/TypoScript/ContactForm/setup.txt";s:4:"23fa";s:46:"Configuration/TypoScript/DoubleOptIn/setup.txt";s:4:"3e03";s:47:"Configuration/TypoScript/DoubleOptOut/setup.txt";s:4:"ded9";s:40:"Configuration/TypoScript/OptIn/setup.txt";s:4:"aa23";s:41:"Configuration/TypoScript/OptOut/setup.txt";s:4:"a520";s:42:"Resources/Private/Language/formhandler.xml";s:4:"db3d";s:40:"Resources/Private/Language/locallang.xml";s:4:"e430";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d60d";s:48:"Resources/Private/Templates/example_contact.html";s:4:"c6b9";s:52:"Resources/Private/Templates/example_doubleoptin.html";s:4:"5652";s:53:"Resources/Private/Templates/example_doubleoptout.html";s:4:"4b3e";s:46:"Resources/Private/Templates/example_optin.html";s:4:"0266";s:47:"Resources/Private/Templates/example_optout.html";s:4:"a33d";s:47:"Resources/Private/Templates/mastertemplate.html";s:4:"a7a1";s:29:"Resources/Public/CSS/base.css";s:4:"f06b";s:31:"Resources/Public/CSS/colors.css";s:4:"697c";s:30:"Resources/Public/CSS/forms.css";s:4:"0d05";s:32:"Resources/Public/CSS/special.css";s:4:"ed62";s:31:"Resources/Public/CSS/styles.css";s:4:"43bc";s:38:"Resources/Public/Icons/button-grey.png";s:4:"765d";s:38:"Resources/Public/Icons/button_gray.png";s:4:"758c";s:37:"Resources/Public/Icons/button_red.png";s:4:"5962";s:40:"Resources/Public/Icons/button_yellow.png";s:4:"1228";s:33:"Resources/Public/Icons/delete.png";s:4:"4249";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:14:"doc/manual.sxw";s:4:"1d29";}',
);

?>