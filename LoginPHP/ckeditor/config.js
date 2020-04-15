/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#c9b6e4';
	config.width = 850;
	config.height = 350;
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'insert', groups: [ 'insert', 'Youtube' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		'/',
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'About,Styles,Flash,Table,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox,Form,HiddenField,CreateDiv,Save,NewPage,Preview,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Superscript,Subscript,CopyFormatting,RemoveFormat,Smiley,PageBreak,Iframe,Replace,Blockquote,Unlink,Anchor,TextColor,BGColor,Maximize,ShowBlocks,BidiLtr,BidiRtl';
    config.extraPlugins = 'youtube'; /*se agrego add on de youtube*/
	config.extraPlugins = 'templates';
	
};
