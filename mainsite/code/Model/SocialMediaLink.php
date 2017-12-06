<?php
use SaltedHerring\Debugger;
/**
 * @file SocialMediaLink
 * @author Leo Chen <leo@saltedherring.com>
 *
 */
class SocialMediaLink extends Link
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'SocialMedia'   =>  'Varchar(64)'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Page'          =>  'ContactPage',
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'SocialMedia'
        ]);

        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create(
                'SocialMedia',
                'Social media',
                $this->config()->SocialMedias
            )->setEmptyString('- select social media -'),
            'Title'
        );

        return $fields;
    }

    public function getSocialMediaName()
    {
        return Config::inst()->get('SocialMedia', 'ClassNames')[$this->SocialMedia];
    }

    public function getData()
    {
        $data           =   parent::getData();
        $data['media']  =   $this->SocialMedia;
        $data['class']  =  'fa fa-' . $data['media'];

        return $data;
    }
}
