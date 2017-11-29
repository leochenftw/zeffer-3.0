<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class ImageBreakExtension extends DataExtension
{
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'ImageBreak'    =>  'Image'
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $owner = $this->owner;
        $fields->addFieldToTab(
            'Root.Main',
            UploadField::create(
                'ImageBreak',
                'Image Break'
            )
        );
        return $fields;
    }
}
