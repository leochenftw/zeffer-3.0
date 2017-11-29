<?php
use SaltedHerring\Debugger;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class NewsLandingPage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [
        'NewsItem'
    ];
    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'Lumberjack'
    ];

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
        $fields =   parent::getCMSFields();
        $grid   =   $fields->fieldByName('Root.ChildPages.ChildPages');
        $grid->getConfig()
            ->removeComponentsByType('GridFieldPaginator')
            ->addComponents(
                new GridFieldPaginatorWithShowAll(30),
                new GridFieldOrderableRows('Sort')
            );

        $dataColumns = $grid->getConfig()->getComponentByType('GridFieldDataColumns');

        $dataColumns->setDisplayFields([
            'Type'      =>  'Type',
            'Title'     =>  'Page name'
        ]);

        return $fields;
    }

    public function getData()
    {
        $data               =   [
                                    'title'             =>  !empty($this->AlternativeTitle) ? $this->AlternativeTitle : $this->title,
                                    'content'           =>  $this->Content,
                                    'hero'              =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                                    'articles'          =>  NewsItem::get()->getData()
                                ];
        return $data;
    }
}

class NewsLandingPage_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
