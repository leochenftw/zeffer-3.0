<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Award extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Year'          =>  'Int',
        'AwardClass'    =>  'Varchar(128)',
        'Competition'   =>  'Varchar(128)',
        'Cider'         =>  'Varchar(128)'
    ];

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = [
        'Year',
        'AwardClass',
        'Competition',
        'Cider'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Page'      =>  'Awards',
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension'
    ];

    public function getData()
    {
        return  [
                    'year'          =>  $this->Year,
                    'class'         =>  $this->AwardClass,
                    'competition'   =>  $this->Competition,
                    'cider'         =>  $this->Cider
                ];
    }

    /**
     * Event handler called before writing to the database.
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if (empty($this->PageID)) {
            if ($page = Awards::get()->first()) {
                $this->PageID = $page->ID;
            }
        }
    }
}
