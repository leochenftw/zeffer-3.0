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
        'SiteLogo'                      =>  'Image',
        'SubscriptionHero'              =>  'Image',
        'TopStripePromo'                =>  'Link',
        'PopupImage'                    =>  'Image',
        'PopupLinkTo'                   =>  'Link'
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
        $fields->addFieldToTab(
            'Root.Subscription',
            SaltedUploader::create(
                'SubscriptionHero',
                'Subscription section hero'
            )//->setCropperRatio(170/60),
        );
        $fields->addFieldToTab('Root.Main', new TextField('Copyright', 'Copyright'));
        $fields->addFieldToTab('Root.Main', new TextField('SiteVersion', 'Site Version'));
        $fields->addFieldsToTab(
            'Root.AlertAndPopup',
            [
                LiteralField::create(
                    'SeparatorTop',
                    '<h2 class="title">Alert Stripe</h2>'
                ),
                LinkField::create(
                    'TopStripePromoID',
                    'Top stripe promo'
                ),
                LiteralField::create(
                    'SeparatorMid',
                    '<h2 class="title">Pop-up promo</h2>'
                ),
                LinkField::create(
                    'PopupLinkToID',
                    'Pop-up image links to'
                ),
                UploadField::create(
                    'PopupImage',
                    'Popup Image'
                )
            ]
        );
    }

    public function getPopupData()
    {
        if ($this->owner->PopupLinkTo()->exists() && $this->owner->PopupImage()->exists()) {
            $link_to                =   $this->owner->PopupLinkTo();
            return  [
                        'title'     =>  $link_to->Title,
                        'url'       =>  $link_to->getLinkURL(),
                        'image'     =>  $this->owner->PopupImage()->SetWidth(600)->URL
                    ];
        }
        return null;
    }
}
