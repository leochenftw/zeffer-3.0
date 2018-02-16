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
     * Database fields
     * @var array
     */
    private static $db = [
        'VideoUrl'      =>  'Varchar(1024)',
        'VideoID'       =>  'Varchar(11)'
    ];
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'ImageBreak'    =>  'Image',
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $owner = $this->owner;
        $fields->addFieldsToTab(
            'Root.SectionHero',
            [
                UploadField::create(
                    'ImageBreak',
                    'Image Break'
                ),
                YouTubeField::create('VideoID', 'YouTube Video')->setDescription('Please make sure that you have already uploaded an image in the Image Break field')
            ]
        );
        return $fields;
    }

    public function getVideoSource()
    {
        return 'https://www.youtube.com/embed/' . $this->owner->VideoID;
    }

    public function getThumbnailURL()
    {
        if (!empty($this->owner->VideoID)) {
            return 'https://img.youtube.com/vi/' . $this->owner->VideoID . '/hqdefault.jpg';
        }

        return 'https://via.placeholder.com/1920x1080';
    }
}
