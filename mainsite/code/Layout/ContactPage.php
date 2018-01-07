<?php

use SaltedHerring\Debugger;
use SaltedHerring\Grid;

class ContactPage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];

    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'Latitude'          =>  'Varchar(64)',
        'Longitude'         =>  'Varchar(64)',
        'ZoomRate'          =>  'Decimal'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'FallbackMapImage'  =>  'Image'
    ];

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'SocialMedias'      =>  'SocialMediaLink',
        'ContactMethods'    =>  'ContactMethod'
    ];

    public function getData()
    {
        $data               =   [
                                    'title'     =>  !empty($this->AlternativeTitle) ? $this->AlternativeTitle : $this->title,
                                    'content'   =>  $this->Content,
                                    'hero'      =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                                    'lat'       =>  $this->Latitude,
                                    'lng'       =>  $this->Longitude,
                                    'api_key'   =>  Config::inst()->get('GoogleAPIs', 'Map'),
                                    'fallback'  =>  $this->FallbackMapImage()->exists() ? $this->FallbackMapImage()->SetWidth(800)->URL : null,
                                    'methods'   =>  $this->exists() ? $this->ContactMethods()->getData() : null,
                                    'socials'   =>  $this->exists() ? $this->SocialMedias()->getData() : null,
                                ];
        return $data;
    }

    private static $description = 'Contact page. You may only create 1 Contact page at all times';

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }
    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($api = Config::inst()->get('GoogleAPIs', 'Map')) {
            $fields->addFieldToTab(
                'Root.Map',
                LiteralField::create('GoogleMapAPI', '<h2>API: ' . $api . '</h2>')
            );
        } else {
            $fields->addFieldToTab(
                'Root.Map',
                LiteralField::create('GoogleMapAPI', '<h2>Please define Google API in your config.yml file</h2>')
            );
        }

        if ($this->exists()) {
            $fields->addFieldsToTab(
                'Root.ContactMethods',
                [
                    Grid::make('ContactMethods', 'Contact methods', $this->ContactMethods()),
                    Grid::make('SocialMedias', 'Social medias', $this->SocialMedias())
                ]
            );
        }

        $fields->addFieldsToTab(
            'Root.Map',
            [
                TextField::create(
                    'Latitude',
                    'Latitude'
                ),
                TextField::create(
                    'Longitude',
                    'Longitude'
                ),
                TextField::create(
                    'ZoomRate',
                    'ZoomRate'
                ),
                UploadField::create(
                    'FallbackMapImage',
                    'Fallback map image'
                )
            ]
        );

        return $fields;
    }
}

class ContactPage_Controller extends Page_Controller
{

}
