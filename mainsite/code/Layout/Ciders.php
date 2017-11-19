<?php
use SaltedHerring\Debugger;
use SaltedHerring\Grid;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Ciders extends Page
{

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'Ciders'        =>  'Cider',
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($this->exists()) {
            $fields->addFieldToTab(
                'Root.Ciders',
                Grid::make('Ciders', 'Ciders', $this->Ciders())
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
class Ciders_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
