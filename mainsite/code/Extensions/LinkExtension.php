<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class LinkExtension extends DataExtension
{
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Page'      =>  'BuynowPage',
    ];
}
