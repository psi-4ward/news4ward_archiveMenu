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


namespace Psi\News4ward;

class ArchiveMenuHelper extends \System
{

	/**
	 * Return the WHERE-condition if a the url has an archive-parameter
	 * @return bool|string
	 */
	public function archiveFilter()
	{
		if(!$this->Input->get('archive')) return;

		if(preg_match("~^\d{4}$~",$this->Input->get('archive')))
		{
			// filter for year
			$year = $this->Input->get('archive');
			return array
			(
				'where'     => 'YEAR(FROM_UNIXTIME(start)) = ?',
				'values'    => array($year)
			);
		}
		elseif(preg_match("~^\d{4}-\d{1,2}$~",$this->Input->get('archive')))
		{
			// filter for year and month
			list($year,$month) = explode('-',$this->Input->get('archive'));
			return array
			(
				'where'     => 'YEAR(FROM_UNIXTIME(tl_news4ward_article.start)) = ? AND MONTH(FROM_UNIXTIME(tl_news4ward_article.start)) = ?',
				'values'    => array($year, $month)
			);
		}

		return;
	}
}

