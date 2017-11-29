<?php
use SaltedHerring\Grid;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Awards extends Page
{
    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'Awards'        =>  'Award'
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
                'Root.Awards',
                Grid::make('Awards', 'Awards', $this->Awards())
            );
        }
        return $fields;
    }

    public function getData()
    {
        return  [
                    'id'        =>  $this->ID,
                    'title'     =>  $this->getSectionTitle(),
                    'content'   =>  $this->Content,
                    'hero'      =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                    'awards'    =>  $this->Awards()->exists() ? $this->Awards()->getData() : null
                ];
    }

}

class Awards_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
