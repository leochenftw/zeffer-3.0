<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Tag extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Title'     =>  'Varchar(128)'
    ];

    /**
     * Belongs_many_many relationship
     * @var array
     */
    private static $belongs_many_many = [
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
