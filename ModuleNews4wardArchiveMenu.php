<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * News4ward
 * a contentelement driven news/blog-system
 *
 * @author Christoph Wiechert <wio@psitrax.de>
 * @copyright 4ward.media GbR <http://www.4wardmedia.de>
 * @package news4ward_tags
 * @filesource
 * @licence LGPL
 */

class ModuleNews4wardArchiveMenu extends News4ward
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
			$objTemplate = new BackendTemplate('be_wildcard');

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
		$years = $this->Database->prepare('SELECT DISTINCT(YEAR(FROM_UNIXTIME(start))) AS jahr FROM tl_news4ward_article WHERE pid IN (?) ORDER BY jahr DESC')
					->execute(implode(',',$this->news_archives));

		if(!$years->numRows)
		{
			$this->Template->years = array();
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

		$arr = array();
		while($years->next())
		{
			$arr[] = array(
				'year' => $years->jahr,
				'href' => $this->generateFrontendUrl($objJumpTo->row(),'/year/'.$years->jahr)
			);
		}

		$this->Template->years = $arr;
	}

}
?>