<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Foldergallery',
	'Folder Gallery'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_foldergallery';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_foldergallery.xml');

if (TYPO3_MODE == 'BE')
{
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['foldergallery_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Hooks/class.foldergallery_wizicon.php';
}
