<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Category extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'     =>  'Varchar(128)'
    ];

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'News'      =>  'NewsItem'
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SlugifyExtension'
    ];
}
