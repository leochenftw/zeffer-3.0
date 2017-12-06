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
     * Database fields
     * @var array
     */
    private static $db = [
        'Lightboxed'                    =>  'Boolean',
    ];
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Page'                          =>  'BuynowPage',
    ];

    public function getData()
    {
        return         [
                            'title'     =>  $this->owner->Title,
                            'url'       =>  $this->owner->getLinkURL(),
                            'new_tab'   =>  $this->owner->OpenInNewWindow,
                            'lightbox'  =>  $this->owner->Lightboxed
                        ];
    }
}
