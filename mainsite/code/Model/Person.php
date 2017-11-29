<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Person extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'     =>  'Varchar(16)',
        'Content'   =>  'HTMLText',
    ];
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Photo'     =>  'Image',
        'Page'      =>  'People'
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
                    'title'     =>  $this->Title,
                    'content'   =>  $this->Content,
                    'photo'     =>  $this->Photo()->exists() ? $this->Photo()->SetWidth(640)->URL : null
                ];
    }
}
