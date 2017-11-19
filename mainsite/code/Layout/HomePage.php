<?php
use SaltedHerring\Debugger;
use SaltedHerring\Grid;
class HomePage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];

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
        'CarouselItems' =>  'CarouselItem',
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
                'Root.Carousel',
                Grid::make('CarouselItems', 'Carousel items', $this->CarouselItems())
            );
        }
        return $fields;
    }


}

class HomePage_Controller extends Page_Controller
{

}
