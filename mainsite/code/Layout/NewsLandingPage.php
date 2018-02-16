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
     * Database fields
     * @var array
     */
    private static $db = [
        'NewsPerLoad'           =>  'Int'
    ];

    /**
     * Belongs_to relationship
     * @var array
     */
    private static $defaults = [
        'NewsPerLoad'           =>  3
    ];

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
            'Type'          =>  'Type',
            'Title'         =>  'Page name'
        ]);

        $fields->addFieldToTab(
            'Root.ChildPages',
            TextField::create(
                'NewsPerLoad',
                'Number of news items per page/load'
            )
        );

        return $fields;
    }

    public function getData()
    {
        $data               =   [
                                    'title'             =>  !empty($this->AlternativeTitle) ? $this->AlternativeTitle : $this->title,
                                    'content'           =>  $this->Content,
                                    'hero'              =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                                    'articles'          =>  self::Paginate(NewsItem::get(), $this->NewsPerLoad), //NewsItem::get()->getData()
                                    'video'             =>  !empty($this->VideoID) ?
                                                            [
                                                                'video_url'     =>  $this->getVideoSource() . '?autoplay=1&rel=0',
                                                                'video_cover'   =>  $this->getThumbnailURL()
                                                            ] :
                                                            null
                                ];
        return $data;
    }

    public static function Paginate($articles, $pageSize)
    {
        $artcile_count                  =   $articles->count();
        $request                        =   Controller::curr()->request;

        if (empty($artcile_count)) {
            return  [
                        'list'          =>  [],
                        'count'         =>  0,
                        'message'       =>  'No news or blog yet'
                    ];
        }

        $start                          =   $request->getVar('start');

        if ($artcile_count > $pageSize) {
            $paged                      =   new PaginatedList($articles, $request);

            $paged->setPageLength($pageSize);

            $articles                   =   $paged;
            $list                       =   $articles->getIterator();
            $data                       =   [];

            foreach ($list as $item)
            {
                $data[]                 =   $item->getData();
            }

            if ($paged->MoreThanOnePage()) {
                if ($paged->NotLastPage()) {
                    // $pagination         =   $paged->NextLink() . (!empty($this->keywords) ? ('&keywords=' . $this->keywords . '&csrf=' . Session::get('SecurityID')) : '');
                    $news_link          =   NewsLandingPage::get()->first()->Link();

                    // Debugger::inspect($paged->NextLink() . ' : ' . trim($news_link, '/'));

                    $pagination         =   '/' . trim($news_link, '/') . trim(str_replace(trim($news_link, '/'), '', $paged->NextLink()), '/'); // . (!empty($this->keywords) ? ('&keywords=' . $this->keywords) : '');
                    return  [
                        'list'          =>  $data,
                        'count'         =>  $artcile_count,
                        'pagination'    =>  ['url' => $pagination]
                    ];
                }

                return  array(
                    'list'              =>  $data,
                    'count'             =>  $artcile_count,
                    'pagination'        =>  ['message' => null]
                );
            }
        }

        $data                           =   $articles->getData();

        return ['list' => $data, 'count' => $artcile_count, 'pagination' => ['message' => null]];
    }
}

class NewsLandingPage_Controller extends Page_Controller
{
    public function AjaxResponse()
    {
        $data                           =   parent::AjaxResponse();
        $data['news']                   =   $this->getData();
        return $data;
    }

    public function Paginated()
    {
        $request                    =   $this->request;
        $children                   =   null;
        if ($c_slug = $request->getVar('category')) {
            if ($category           =   Category::get()->filter(['Slug' => $c_slug])->first()) {
                $children           =   $category->News();
            }
        }

        if ($t_slug = $request->getVar('tag')) {
            if ($tag                =   Tag::get()->filter(['Slug' => $t_slug])->first()) {
                $children           =   $tag->News();
            }
        }

        $children                   =   empty($c_slug) && empty($t_slug) ? $this->AllChildren() : $children;

        $paged                      =   new PaginatedList($children, $request);

        return $paged->setPageLength($this->NewsPerLoad);
    }

    public function getAllCategories()
    {
        $all                        =   Category::get();
        $list                       =   [];
        $slug                       =   $this->request->getVar('category');
        $current_taken              =   false;

        foreach ($all as $individual)
        {
            $list[]                 =   [
                                            'Title'     =>  $individual->Title,
                                            'URL'       =>  '/news?category=' . $individual->Slug,
                                            'Current'   =>  $slug == $individual->Slug
                                        ];

            if ($slug == $individual->Slug) {
                $current_taken      =   true;
            }
        }

        $first_item                 =   [
                                            'Title'     =>  'All',
                                            'URL'       =>  '/news',
                                            'Current'   =>  !$current_taken
                                        ];

        array_unshift($list, $first_item);

        return ArrayList::create($list);
    }

    public function getAllTags()
    {
        $all                        =   Tag::get();
        $list                       =   [];
        $slug                       =   $this->request->getVar('category');
        $current_taken              =   false;

        foreach ($all as $individual)
        {
            $list[]                 =   [
                                            'Title'     =>  $individual->Title,
                                            'URL'       =>  '/news?tag=' . $individual->Slug,
                                            'Current'   =>  $slug == $individual->Slug
                                        ];

            if ($slug == $individual->Slug) {
                $current_taken      =   true;
            }
        }

        $first_item                 =   [
                                            'Title'     =>  'All',
                                            'URL'       =>  '/news',
                                            'Current'   =>  !$current_taken
                                        ];

        array_unshift($list, $first_item);

        return ArrayList::create($list);
    }
}
