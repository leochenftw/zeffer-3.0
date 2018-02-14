<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class CarouselItem extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'         =>  'Varchar(128)',
        'Content'       =>  'HTMLText',
        'TitleAsLink'   =>  'Boolean',
        'ScrollTo'      =>  'Varchar(128)',
        'ButtonLabel'   =>  'Varchar(64)',
        'TextMaxWidth'  =>  'Int'
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension'
    ];
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Background'    =>  'Image',
        'TextImage'     =>  'Image',
        'HomePage'      =>  'HomePage'
    ];

    public function getData()
    {
        return  [
                    'id'            =>  $this->ID,
                    'title'         =>  $this->Title,
                    'content'       =>  $this->Content . ($this->TitleAsLink ? '' : (empty($this->ButtonLabel) ? '' : '<p><a class="is-info button is-large btn-go-to" href="#" data-scrollto="' . $this->ScrollTo . '">' . $this->ButtonLabel . '</a></p>')),
                    'title_as_link' =>  $this->TitleAsLink,
                    'scroll_to'     =>  $this->ScrollTo,
                    'img_max_width' =>  !empty($this->TextMaxWidth) ? $this->TextMaxWidth : null,
                    'background'    =>  $this->Background()->exists() ? $this->Background()->SetWidth(1980)->URL : null,
                    'overlay'       =>  $this->TextImage()->exists() ? $this->TextImage()->URL : null
                ];
    }

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'TextMaxWidth'
        ]);
        return $fields;
    }
}
