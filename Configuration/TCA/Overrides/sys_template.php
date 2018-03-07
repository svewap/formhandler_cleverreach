<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript',
    'Formhandler Cleverreach API'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript/ContactForm',
    'Formhandler Cleverreach Contact Form'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript/DoubleOptIn',
    'Formhandler Cleverreach DoubleOptIn'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript/DoubleOptOut',
    'Formhandler Cleverreach DoubleOptOut'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript/OptIn',
    'Formhandler Cleverreach OptIn'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formhandler_cleverreach',
    'Configuration/TypoScript/OptOut',
    'Formhandler Cleverreach OptOut'
);
