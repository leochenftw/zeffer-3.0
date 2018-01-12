<?php
class CustomSiteConfig extends DataExtension
{
    public static $db = [
        'Copyright'                     =>  'Varchar(64)',
        'GoogleSiteVerificationCode'    =>  'Varchar(128)',
        'GoogleAnalyticsCode'           =>  'Varchar(20)',
        'SiteVersion'                   =>  'Varchar(10)',
        'GoogleCustomCode'              =>  'HTMLText'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'SiteLogo'                      =>  'Image'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Google", new TextField('GoogleSiteVerificationCode', 'Google Site Verification Code'));
        $fields->addFieldToTab("Root.Google", new TextField('GoogleAnalyticsCode', 'Google Analytics Code'));
        $fields->addFieldToTab("Root.Google", new TextareaField('GoogleCustomCode', 'Custom Google Code'));
        $fields->addFieldToTab(
            'Root.Main',
            SaltedUploader::create(
                'SiteLogo',
                'Website logo'
            ), //->setCropperRatio(170/60),
            'Title'
        );
        $fields->addFieldToTab('Root.Main', new TextField('Copyright', 'Copyright'));
        $fields->addFieldToTab('Root.Main', new TextField('SiteVersion', 'Site Version'));
    }

}
