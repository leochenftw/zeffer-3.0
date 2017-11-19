<?php
use SaltedHerring\Grid;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class BuynowPage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];
    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'BuyOptions'        =>  'Link'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields             =   parent::getCMSFields();

        if ($this->exists()) {
            $fields->addFieldToTab(
                'Root.BuyOptions',
                Grid::make('BuyOptions', 'Buy options', $this->BuyOptions())
            );
        }

        return $fields;
    }

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }
}

class BuynowPage_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
