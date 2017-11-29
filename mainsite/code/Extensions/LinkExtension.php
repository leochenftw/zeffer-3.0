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

    public function getData()
    {
        return         [
                            'title'     =>  $this->owner->Title,
                            'url'       =>  !empty($this->owner->Email) ? ('mailto:' . $this->owner->Email) : $this->owner->URL,
                            'new_tab'   =>  $this->owner->OpenInNewWindow
                        ];
    }
}
