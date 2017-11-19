<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class Cider extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'ReserveRange'      =>  'Boolean',
        'Subtitle'          =>  'Varchar(128)',
        'See'               =>  'Varchar(128)',
        'Smell'             =>  'Varchar(128)',
        'Taste'             =>  'Varchar(128)',
        'TryMeWith'         =>  'Varchar(128)',
        'Dryness'           =>  'Decimal',
        'Tannin'            =>  'Decimal',
        'Alchohol'          =>  'Decimal',
        'SoldOut'           =>  'Boolean',
        'Availabilities'    =>  'Varchar(16)',
        'CiderColour'       =>  'Varchar(7)',
        'ProductStyle'      =>  'Varchar(100)',
        'ProudctVintage'    =>  'Varchar(16)'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'TitleImage'        =>  'Image',
        'ProductImage'      =>  'Image',
        'ProductSignature'  =>  'Image',
        'Page'              =>  'Ciders'
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension'
    ];
}
