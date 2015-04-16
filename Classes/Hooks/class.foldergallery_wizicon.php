<?php

class foldergallery_wizicon
{
	/**
    * Processing the wizard items array
    *
    * @param array $wizardItems The wizard items
    * @return array Modified array with wizard items
    */
    function proc($wizardItems)
    {
    	$wizardItems['plugins_tx_almgallery'] = array(
        	'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('alm_gallery') . 'Resources/Public/Icons/foldergallery_wizard.gif',
            'title' => $GLOBALS['LANG']->sL('LLL:EXT:alm_gallery/Resources/Private/Language/locallang_db.xlf:tx_almgallery_foldergallery.title'),
            'description' => $GLOBALS['LANG']->sL('LLL:EXT:alm_gallery/Resources/Private/Language/locallang_db.xlf:tx_almgallery_foldergallery.description'),
            'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=almgallery_foldergallery'
        );

        return $wizardItems;
    }
}

?>
