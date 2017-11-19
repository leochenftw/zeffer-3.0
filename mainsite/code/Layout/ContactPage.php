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
                LiteralField::create('GoogleMapAPI', '<h2>API: ' . $api . '</h2>'),
                'Title'
            );
        } else {
            $fields->addFieldToTab(
                'Root.Map',
                LiteralField::create('GoogleMapAPI', '<h2>Please define Google API in your config.yml file</h2>'),
                'Title'
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
                )
            ]
        );

        return $fields;
    }
}

class ContactPage_Controller extends Page_Controller
{

}
