/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.language = 'es';
    // config.uiColor = '#AADC6E';
    //tableresizerowandcolumn
    config.font_defaultLabel = 'Arial';
    config.fontSize_defaultLabel = '12';
    config.fontSize_sizes = '8/11px;9/12px;10/12px;11/15px;12/16px;13/17px;18/24px;20/26px;22/29px;24/32px;26/35px';
    config.extraPlugins = "autogrow,base64image,imageresize,tableresize,quicktable,pastefromexcel,lineheight";
    config.skin = 'office2013';
    config.removeButtons = 'Save,Source,NewPage,DocProps,Preview,Print,Templates,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Image,Flash,Smiley,PageBreak,Iframe,CreateDiv';

};
