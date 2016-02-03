AlmGallery - simple folder gallery

Setup:

Install Plugin
Copy the template file (ext/alm_gallery/Resources/Private/Templates/Foldergallery/Render.html) in your template folder (fileadmin/template)
Design your template
Add template path to your typoscript-plugin-settings (plugin.tx_almgallery.settings.foldergallery.template.render = fileadmin/template/your_gallery.html)
Or make it selectable with (plugin.tx_almgallery.settings.foldergallery.template.select.1 = fileadmin/template/your_gallery.html)
Insert new content element 'FolderGallery'
Select template (optional)
Select image folder
Define MetaTypes & MetaValues

#################################################################################################

TS Settings:

plugin.tx_almgallery {
	settings {
		foldergallery {
			extensions = jpg,jpeg,gif,png
			crop = proportional
			thumbWidth = 400
			thumbHeight = 400
			# template.render = fileadmin/template/foldergallery_1.html
			# template.select.1 = fileadmin/template/foldergallery_1.html
			# template.select.2 = fileadmin/template/foldergallery_2.html
		}
	}
}

Add your own settings to access in the template:
plugin.tx_almgallery.settings.foldergallery.mySetting = myValue

#################################################################################################

Template Vars:

_all
element
settings
meta
images

#################################################################################################

MetaTypes & MetaValues:

Example MetaTypes: Title, Photographer, Tags
Example MetaValues: MyImage; Mr. X; summer, holiday, sun
(types divided by ';' and items devided by ',')

Template access example:
<f:for each="{meta.metaTypeValues.Photographer}" as="val">
	<li class="filter" data-filter="category_{val.special}">{val.normal}</li>
</f:for>

<f:for each="{images}" as="image" iteration="counter">
	<f:image src="{image.url}" alt="{image.meta.Title.0.normal} - {image.meta.Photographer.0.normal}" maxWidth="{settings.thumbWidth}" maxHeight="{settings.thumbHeight}" />
</f:for>

#################################################################################################

ToDo:

- code optimization
- add functionality
- add more gallery-types