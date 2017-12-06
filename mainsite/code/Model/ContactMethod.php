<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class ContactMethod extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'                 =>  'Varchar(64)',
        'Content'               =>  'HTMLText'
    ];
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Page'                  =>  'ContactPage'
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
                    'content'   =>  $this->Content
                ];
    }
}
