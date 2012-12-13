<?php

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


// Palette
$GLOBALS['TL_DCA']['tl_module']['palettes']['news4wardArchiveMenu']    = '{title_legend},name,headline,type;{config_legend},news4ward_archives,news4ward_archivemenu_type,news4ward_filterHint;{redirect_legend},jumpTo;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

// Fields
$GLOBALS['TL_DCA']['tl_module']['fields']['news4ward_archivemenu_type'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_module']['news4ward_archivemenu_type'],
	'inputType'		=> 'select',
	'options'		=> array('month','year'),
	'reference'		=> &$GLOBALS['TL_LANG']['tl_module']['news4ward_archivemenu_type_reference'],
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);