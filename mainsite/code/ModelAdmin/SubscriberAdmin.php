<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class SubscriberAdmin extends ModelAdmin
{
    /**
     * Managed data objects for CMS
     * @var array
     */
    private static $managed_models = [
        'Subscriber'
    ];

    /**
     * URL Path for CMS
     * @var string
     */
    private static $url_segment = 'subscribers';

    /**
     * Menu title for Left and Main CMS
     * @var string
     */
    private static $menu_title = 'Subscribers';


}
