<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Subscriber extends DataObject
{
    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = [
        'FirstName'     =>  'First name',
        'LastName'      =>  'Last name',
        'Email'         =>  'Email'
    ];
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'FirstName'     =>  'Varchar(64)',
        'LastName'      =>  'Varchar(64)',
        'Email'         =>  'Varchar(256)'
    ];
}
