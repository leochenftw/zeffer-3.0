<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class TagAdmin extends ModelAdmin
{
    /**
     * Managed data objects for CMS
     * @var array
     */
    private static $managed_models = ['Tag', 'Category'];

    /**
     * URL Path for CMS
     * @var string
     */
    private static $url_segment = 'tags';

    /**
     * Menu title for Left and Main CMS
     * @var string
     */
    private static $menu_title = 'Tags';


}
