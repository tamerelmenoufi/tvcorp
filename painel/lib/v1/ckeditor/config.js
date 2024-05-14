/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.toolbar_tamer = [
	    [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ],
	    [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
	    [ 'Bold', 'Italic','Image' ]
	];

	config.toolbar_samira = [
	    [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ]
	];

	config.toolbar_imagem = [
	    ['Image' ]
	];

};
