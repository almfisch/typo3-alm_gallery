<?php
namespace Alm\AlmGallery\Controller;

use TYPO3\CMS\Core\Resource\Collection\FolderBasedFileCollection;
use TYPO3\CMS\Extbase\Domain\Model\File;

class FoldergalleryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	function renderAction()
	{
		if($this->settings['foldergallery']['template']['render'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['foldergallery']['template']['render']);
		}
		if($this->settings['foldergallery']['flexform']['templateFile'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['foldergallery']['flexform']['templateFile']);
		}

		$extensions = $this->settings['foldergallery']['extensions'];
		$extensions = explode(',', $extensions);
		$extensions = array_map('trim', $extensions);
		$folderPath = $this->settings['foldergallery']['flexform']['folderPath'];
		$folderPath = explode(':', $folderPath);
		$metaTypes = $this->settings['foldergallery']['flexform']['metaTypes'];
		$metaTypes = explode(',', $metaTypes);
		$metaTypes = array_map('trim', $metaTypes);
		$metaValues = $this->settings['foldergallery']['flexform']['metaValues'];
		$metaValues = explode("\n", $metaValues);
		array_walk($metaValues, function(&$val_1){
			$val_1 = explode(';', $val_1);
			array_walk($val_1, function(&$val_2){
				$val_2 = explode(',', $val_2);
				$val_2 = array_map('trim', $val_2);
			});
		});

		$metaTypeValues = array();
        foreach($metaTypes as $typeKey => $typeValue)
        {
        	foreach($metaValues as $valueKey => $valueValue)
        	{
        		foreach($valueValue[$typeKey] as $key => $val)
        		{
        			$valArr = array();
        			$valArr['normal'] = $val;
        			$valArr['special'] = $valArr['normal'];
        			$valArr['special'] = strtolower($valArr['special']);
        			$valArr['special'] = str_replace(' ', '_', $valArr['special']);

        			$this->gVal = $val;
        			$this->gFound = 0;

        			if(is_array($metaTypeValues[$typeValue]))
        			{
        				array_walk($metaTypeValues[$typeValue], function($walkVal){
        					if($this->gVal == $walkVal['normal'])
        					{
        						$this->gFound = 1;
        					}
        				});
        			}

        			if($this->gFound == 0)
        			{
        				$metaTypeValues[$typeValue][] = $valArr;
        			}
        		}
        	}
        }

        $metaImageValues = array();
       	foreach($metaValues as $keyA => $valueA)
        {
        	foreach($metaTypes as $keyB => $valueB)
        	{
        		foreach($valueA[$keyB] as $keyC => $valueC)
        		{
        			$valArr = array();
        			$valArr['normal'] = $valueC;
        			$valArr['special'] = $valArr['normal'];
        			$valArr['special'] = strtolower($valArr['special']);
        			$valArr['special'] = str_replace(' ', '_', $valArr['special']);

        			$metaImageValues[$keyA][$valueB][] = $valArr;
        		}
        	}
        }

        $meta = array(
        	'metaTypes' => $metaTypes,
        	'metaValues' => $metaValues,
        	'metaTypeValues' => $metaTypeValues,
        	'metaImageValues' => $metaImageValues
        );

		$images = FolderBasedFileCollection::create(
        	array(
            	'storage' => $folderPath[0],
                'folder' => $folderPath[1]
            ),
            TRUE
        );

        $images = $images->toArray();
        $images = $images['items'];
        $imagesFilter = array();
        foreach($images as $image)
        {
        	if(in_array($image['extension'], $extensions))
        	{
        		$imagesFilter[] = $image;
        	}
        }
        foreach($imagesFilter as $key => $value)
        {
        	if(array_key_exists($key, $metaImageValues))
        	{
        		$imagesFilter[$key]['meta'] = $metaImageValues[$key];
        	}
        	else
        	{
        		//$imagesFilter[$key]['meta'] = array();
        	}
        }

		$this->view->assign('settings', $this->settings['foldergallery']);
		$this->view->assign('meta', $meta);
		$this->view->assign('images', $imagesFilter);
	}
}
?>
