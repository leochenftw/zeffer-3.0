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
        'Type'                  =>  'Enum("News,Blog,Awards")'
    ];

    public function populateDefaults()
    {
        $this->DatePublished    =   date('Y-m-d');
        $this->ShowInMenus      =   true;
        $this->ShowInSearch     =   true;
        $this->AuthorID         =   Member::currentUserID();
    }

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Author'                =>  'Member',
        'Category'              =>  'Category'
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
        Requirements::javascript('mainsite/js/quickaddhack.js');
        $fields                 =   parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            DateField::create('DatePublished', 'Date published')->setConfig('showcalendar', true),
            'Title'
        );

        $fields->removeByName([
            'AlternativeTitle',
            'VideoID',
            'MenuToSection'
        ]);

        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create(
                'Type',
                'Type',
                [
                    'News'      =>  'News',
                    'Blog'      =>  'Blog',
                    'Awards'    =>  'Awards'
                ]
            ),
            'Title'
        );

        $source                 =   function()
                                    {
                                        return Category::get()->map()->toArray();
                                    };

        $category_field         =   DropdownField::create(
                                        'CategoryID',
                                        'Category',
                                        $source()
                                    );

        $category_field->useAddNew('Category', $source)->setEmptyString('- select one -');
        $fields->addFieldToTab(
            'Root.Main',
            $category_field,
            'URLSegment'
        );

        $fields->addFieldToTab(
            'Root.Main',
            TagField::create(
                'Tags',
                'Tags',
                Tag::get()
            )
        );

        // $field->useAddNew('Category', $source);


        return $fields;
    }

    public function getData()
    {
        $tags                   =   null;

        if ($this->Tags()->exists()) {
            $tags               =   [];
            $t                  =   $this->Tags();
            foreach ($t as $g)
            {
                $tags[]         =   [
                                        'title'     =>  $g->Title,
                                        'slug'      =>  $g->Slug
                                    ];
            }
        }

        return  [
                    'type'      =>  strtolower($this->Type),
                    'title'     =>  $this->Title,
                    'content'   =>  $this->ContentRefinery(),
                    'published' =>  $this->DatePublished . ' ' . date("H:i:s",strtotime($this->Created)),
                    'url'       =>  $this->AbsoluteLink(),
                    'category'  =>  !empty($this->CategoryID) ?
                                    [
                                        'title'     =>  $this->Category()->Title,
                                        'slug'      =>  $this->Category()->Slug
                                    ] :
                                    null,
                    'tags'      =>  $tags
                ];
    }

    private function ContentRefinery()
    {
        $content                    =   $this->Content;
        $patten                     =   '/\[embed.*\]/';

        preg_match($patten, $content, $match);

        if (!empty($match)) {
            foreach ($match as $raw_embed)
            {
                $video_url              =   str_replace('[/embed]', '', $raw_embed);
                $video_url              =   preg_replace($patten, '', $video_url);
                $video_id               =   $this->YoutubeIDRetriever($video_url);
                $iframe                 =   '<iframe src="https://www.youtube.com/embed/' . $video_id . '?rel=0" frameborder="0" allowfullscreen="1" allow="encrypted-media" width="960" height="540"></iframe>';

                $content                =   str_replace($raw_embed, $iframe, $content);
            }
        }

        return $content;
    }

    private function YoutubeIDRetriever($url)
    {
        $url      =   parse_url($url);
        parse_str($url['query'], $query);
        if (!empty($query['v'])) {
            return $query['v'];
        }

        return '';
    }
}

class NewsItem_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
