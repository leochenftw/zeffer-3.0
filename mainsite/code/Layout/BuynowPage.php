<?php
use SaltedHerring\Grid;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class BuynowPage extends Page
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'SecondaryContent'      =>  'HTMLText'
    ];
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];
    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'BuyOptions'        =>  'BuyOption'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields             =   parent::getCMSFields();
        $fields->addFieldToTab(
            'Root.Main',
            HtmlEditorField::create(
                'SecondaryContent',
                'Secondary Content'
            )
        );

        if ($this->exists()) {
            $fields->addFieldToTab(
                'Root.BuyOptions',
                Grid::make('BuyOptions', 'Buy options', $this->BuyOptions())
            );
        }

        return $fields;
    }

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }

    public function getData()
    {
        $data               =   [
                                    'title'             =>  !empty($this->AlternativeTitle) ? $this->AlternativeTitle : $this->title,
                                    'content'           =>  $this->Content,
                                    'secondary_content' =>  $this->SecondaryContent,
                                    'hero'              =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                                    'options'           =>  [
                                                                'NZ'    =>  $this->exists() ? $this->BuyOptions()->filter(['Region' => 'NZ'])->getData() : null,
                                                                'AUS'   =>  $this->exists() ? $this->BuyOptions()->filter(['Region' => 'AUS'])->getData() : null
                                                            ]
                                ];
        return $data;
    }
}

class BuynowPage_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
