<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * News4ward
 * a contentelement driven news/blog-system
 *
 * @author Christoph Wiechert <wio@psitrax.de>
 * @copyright 4ward.media GbR <http://www.4wardmedia.de>
 * @package news4ward_archiveMenu
 * @filesource
 * @licence LGPL
 */


// Fields
/*
$GLOBALS['TL_DCA']['tl_module']['fields']['news4ward_tags_count'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_module']['news4ward_tags_count'],
	'inputType'	=> 'text',
	'default'	=> 0,
	'eval'		=> array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50')
);*/


// Palette
$GLOBALS['TL_DCA']['tl_module']['palettes']['news4wardArchiveMenu']    = '{title_legend},name,headline,type;{config_legend},news4ward_archives;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

?>