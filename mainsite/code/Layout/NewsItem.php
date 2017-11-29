<?php
use SaltedHerring\Debugger;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class NewsItem extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];
    /**
     * Defines whether a page is displayed within the site tree
     * @var boolean
     */
    private static $show_in_sitetree = false;

    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'DatePublished'         =>  'Date',
        'Type'                  =>  'Enum("News,Blog")'
    ];

    public function populateDefaults()
    {
        $this->DatePublished    =   date('Y-m-d');
        $this->AuthorID         =   Member::currentUserID();
    }

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Author'                =>  'Member'
    ];

    /**
     * Many_many relationship
     * @var array
     */
    private static $many_many = [
        'Tags'                  =>  'Tag'
    ];

    /**
     * Event handler called before writing to the database.
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if (empty($this->AuthorID)) {
            $this->AuthorID     =   Member::currentUserID();
        }
    }

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields                 =   parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            DateField::create('DatePublished', 'Date published')->setConfig('showcalendar', true),
            'Title'
        );

        $fields->removeByName([
            'AlternativeTitle',
            'ImageBreak'
        ]);

        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create(
                'Type',
                'Type',
                [
                    'News'  =>  'News',
                    'Blog'  =>  'Blog'
                ]
            ),
            'Title'
        );

        return $fields;
    }

    public function getData()
    {
        return  [
                    'type'      =>  strtolower($this->Type),
                    'title'     =>  $this->Title,
                    'content'   =>  $this->Content,
                    'published' =>  $this->DatePublished . ' ' . date("H:i:s",strtotime($this->Created)),
                    'url'       =>  $this->AbsoluteLink()
                ];
    }
}

class NewsItem_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
