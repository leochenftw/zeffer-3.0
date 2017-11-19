<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class NewsLandingPage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [
        'NewsItem'
    ];
    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'Lumberjack'
    ];

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }
}

class NewsLandingPage_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
