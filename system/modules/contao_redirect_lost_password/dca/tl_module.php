<?php
/**
 * Bright Cloud Studio's Contao Redirect Lost Password
 *
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/contao-redirect-lost-password
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

 /* Extend the tl_module palettes */
$GLOBALS['TL_DCA']['tl_module']['palettes']['lostPassword'] = str_replace('{email_legend:hide}', ',jumpToFailed,{email_legend:hide}', $GLOBALS['TL_DCA']['tl_module']['palettes']['lostPassword']);

$GLOBALS['TL_DCA']['tl_module']['fields']['jumpToAlternative'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['jumpToAlternative'],
  'inputType'               => 'pageTree',
  'foreignKey'              => 'tl_page.title',
  'eval'                    => array('fieldType'=>'radio'),
  'sql'                     => "int(10) unsigned NOT NULL default 0",
  'relation'                => array('type'=>'hasOne', 'load'=>'lazy')
);
