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
        'ScrollTo'      =>  'Varchar(128)'
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
}
