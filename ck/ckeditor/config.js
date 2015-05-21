/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'ck/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'ck/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = 'ck/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = 'ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
	config.filebrowserImageUploadUrl = 'ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
	config.filebrowserFlashUploadUrl = 'ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案
};


