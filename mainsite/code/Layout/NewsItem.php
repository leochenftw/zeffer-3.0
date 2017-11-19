<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class NewsItem extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];
    /**
     * Defines whether a page is displayed within the site tree
     * @var boolean
     */
    private static $show_in_sitetree = false;

    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Type'      =>  'Enum("News,Blog")'
    ];
}

class NewsItem_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
