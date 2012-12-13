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


/**
 * @copyright 4ward.media 2011 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */
 
// FE-Modules
$GLOBALS['FE_MOD']['news4ward']['news4wardArchiveMenu'] = '\News4ward\Module\ArchiveMenu';

// News4wardList Filter HOOK
$GLOBALS['TL_HOOKS']['News4wardListFilter'][] = array('\News4ward\ArchiveMenuHelper','archiveFilter');