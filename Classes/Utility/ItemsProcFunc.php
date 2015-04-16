<?php
namespace Alm\AlmGallery\Utility;

class ItemsProcFunc
{
	function templateList($params, $conf)
	{
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		//$settings = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		$settings = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$settings = $settings['plugin.']['tx_almgallery.']['settings.']['foldergallery.']['template.']['select.'];

		$params['items'][] = array(0 => '', 1 => 0);

		if(is_array($settings))
		{
			foreach($settings as $key => $value)
			{
				$params['items'][] = array(0 => $key . ': ' . $value, 1 => $value);
			}
		}

        return $params;
	}
}

?>
