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

namespace Psi\News4ward\Module;

class ArchiveMenu extends Module
{
    /**
   	 * Template
   	 * @var string
   	 */
   	protected $strTemplate = 'mod_news4ward_archivemenu';


    /**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### News4ward ArchiveMenu ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->news_archives = $this->sortOutProtected(deserialize($this->news4ward_archives));

		// Return if there are no archives
		if (!is_array($this->news_archives) || count($this->news_archives) < 1)
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
    {
		switch($this->news4ward_archivemenu_type)
		{
			case 'year':
				$objItems = $this->Database->execute('
					SELECT YEAR(FROM_UNIXTIME(start)) AS item, count(id) AS quantity
					FROM tl_news4ward_article
					WHERE status = "published" AND ((start = "" || start < UNIX_TIMESTAMP()) && (stop = "" OR stop > UNIX_TIMESTAMP())) AND pid IN ('.implode(',', $this->news_archives).')
					GROUP BY item
					ORDER BY item DESC');
				break;

			case 'month':
				$objItems = $this->Database->execute('
				SELECT DATE_FORMAT(FROM_UNIXTIME(start), "%Y-%m") AS item, count(id) AS quantity
				FROM tl_news4ward_article
				WHERE status = "published" AND ((start = "" || start < UNIX_TIMESTAMP()) && (stop = "" OR stop > UNIX_TIMESTAMP())) AND pid IN ('.implode(',',$this->news_archives).')
				GROUP BY item
				ORDER BY item DESC');
				break;
			
			default:
				return;
				break;
		}


		if(!$objItems->numRows)
		{
			$this->Template->items = array();
			return;
		}

		// get jumpTo
		if($this->jumpTo)
		{
			$objJumpTo = $this->Database->prepare('SELECT id,alias FROM tl_page WHERE id=?')->execute($this->jumpTo);
			if(!$objJumpTo->numRows)
			{
				$objJumpTo = $GLOBALS['objPage'];
			}
		}
		else
		{
			$objJumpTo = $GLOBALS['objPage'];
		}

        $this->Template->resetHref = $this->generateFrontendUrl($objJumpTo->row());

        $arr = array();
		while($objItems->next())
		{
			$arr[] = array(
				'item' => $objItems->item,
				'href' => $this->generateFrontendUrl($objJumpTo->row(),'/archive/'.$objItems->item),
				'quantity' => ($this->news4ward_showQuantity) ? $objItems->quantity : '',
				'active' => ($this->Input->get('archive') == $objItems->item)
			);

			// set active item for the active filter hinting
			if($this->Input->get('archive') == $objItems->item)
			{
				if(!isset($GLOBALS['news4ward_filter_hint']))
				{
					$GLOBALS['news4ward_filter_hint'] = array();
				}

				$GLOBALS['news4ward_filter_hint']['archive'] = array
				(
					'hint' 			=> $this->news4ward_filterHint,
					'value'			=> $objItems->item
				);

			}
		}

		$this->Template->items = $arr;
	}

}
