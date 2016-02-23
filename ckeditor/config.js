/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
// Uploadcare Public Key. Co the dang tai tai khoan Uploadcare rieng, va dua phan cau hinh vao <head> cua template admin. Sau do them phan cau hinh public key cho tung website trong AdminCP
UPLOADCARE_PUBLIC_KEY = '2fea963e0183026699e1';

CKEDITOR.plugins.addExternal('fmath_formula', 'plugins/fmath_formula/', 'plugin.js');

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	// config.uiColor = '#AADC6E';
	config.skin = 'moonocolor';
	config.tabSpaces = 4;
	config.font_names = 'GoogleWebFonts;' + config.font_names;
	config.googleMaps_CenterLat = 10.78823;
	config.googleMaps_CenterLon = 106.66010;
	config.googleMaps_Zoom = 15;
    // File Manager
	config.filebrowserBrowseUrl = '/plugins/filemanager/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/plugins/filemanager/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '/plugins/filemanager/browse.php?type=flash';
	config.filebrowserUploadUrl = '/plugins/filemanager/upload.php?type=files';
	config.filebrowserImageUploadUrl = '/plugins/filemanager/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '/plugins/filemanager/upload.php?type=flash';
    
	//config.filebrowserBrowseUrl = "/plugins/filemanager/";
	config.doksoft_uploader_url = '../ckeditor/plugins/doksoft_uploader/uploader.php';
	config.filebrowserGoogledocsUploadUrl = '/plugins/googledocs/documentUpload.php';
	config.filebrowserGoogledocsBrowseUrl = '/plugins/googledocs/documentsList.php';
	config.doksoft_youtube_apiKey = 'AIzaSyC6lArMhqNgk75skuQbFbUGr44b9vNMRCw';
	config.doksoft_youtube_maxResults = 25;
	config.wordcount = {
		showWordCount: true,
		showCharCount: true,
		countHTML: false
	};
	config.uploadcare = {
        multiple: true
    }
	
	config.extraPlugins = 'dialogui,dialog,lineutils,widget,panelbutton,floatpanel,liststyle,textselection,xml,ajax,fmath_formula,codeTag,lightbox,ckeditor-gwf-plugin,googlemaps,doksoft_maps,doksoft_image,doksoft_image_embed,doksoft_instant_image,doksoft_rehost_image,doksoft_file,doksoft_instant_file,doksoft_rehost_file,doksoft_preview,doksoft_instant_preview,doksoft_html,doksoft_button,doksoft_special_symbols,doksoft_table,doksoft_templates,doksoft_youtube,doksoft_font_awesome,fmath_formula,page2images,slideshow,codeTag,sourcedialog,codemirror,uploadcare,oembed,allmedias,codesnippet,qrc,templates,backgrounds,googledocs,performx,texttransform,wordcount,tabletools,tableresize,smallerselection';
	// You can load the floating-tools menu for floating menu in editor zone (style, font,...)
	// You can load the devtools plugin for debug
	// You can load the sharedspace plugin for combine multiple textarea using 1 toolbar and element path

	config.toolbar = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'autoFormat', 'CommentSelectedRange', 'UncommentSelectedRange', 'AutoComplete',  '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'BidiLtr', 'BidiRtl', 'Uploadcare' ] },
	{ name: 'insert', items: [ 'Image', 'doksoft_image', 'doksoft_instant_image', 'doksoft_rehost_image', 'doksoft_preview', 'doksoft_instant_preview', 'doksoft_image_embed', 'Slideshow', 'lightbox', 'doksoft_file', 'doksoft_instant_file', 'doksoft_rehost_file', '-', 'GoogleMaps', 'doksoft_maps', 'doksoft_youtube', 'oembed','allmedias', 'Flash', '-', 'doksoft_button', 'doksoft_html', 'doksoft_special_symbols', 'doksoft_font_awesome', 'doksoft_table', 'doksoft_templates', 'Table', 'fmath_formula', 'page2images', '-', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ,'-', 'Link', 'Unlink', 'Anchor', 'Code', 'CodeSnippet', 'qrc', 'Templates', 'Googledocs', '-', 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField', '-', 'Maximize', 'ShowBlocks', 'pxTemplate', 'pxTable', 'pxAccessibility'] },
	'/',
	{ name: 'alignment', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'others', items: [ '-' ] },
];

// Toolbar groups configuration.
config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	{ name: 'forms' },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'links' },
	{ name: 'insert' },
	'/',
	{ name: 'alignment' },
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'others' },
];
};
