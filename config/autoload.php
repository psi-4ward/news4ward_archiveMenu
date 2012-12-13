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


// Register the namespace
ClassLoader::addNamespace('Psi');

// Register the classes
ClassLoader::addClasses(array
(
	'Psi\News4ward\Module\ArchiveMenu'   	=> 'system/modules/news4ward_archiveMenu/Module/ArchiveMenu.php',
	'Psi\News4ward\ArchiveMenuHelper'   		=> 'system/modules/news4ward_archiveMenu/ArchiveMenuHelper.php',
));

// Register the templates
TemplateLoader::addFiles(array
(
	'mod_news4ward_archiveMenu' 				=> 'system/modules/news4ward_archiveMenu/templates',
));
