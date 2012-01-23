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

class News4wardArchiveMenuHelper extends System
{

	/**
	 * Return the WHERE-condition if a the url has an year-parameter
	 * @return bool|string
	 */
	public function archiveFilter()
	{
		if(!$this->Input->get('year') || !preg_match("~^\d{4}$~",$this->Input->get('year'))) return false;

		$year = mysql_real_escape_string($this->Input->get('year'));

		return 'YEAR(FROM_UNIXTIME(start)) = "'.$year.'"';
	}
}

?>