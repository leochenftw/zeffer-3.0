<?php
use SaltedHerring\Debugger;
use SaltedHerring\Grid;
use SaltedHerring\SaltedCache;

class HomePage extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'CarouselItems' =>  'CarouselItem',
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($this->exists()) {
            $fields->addFieldToTab(
                'Root.Carousel',
                Grid::make('CarouselItems', 'Carousel items', $this->CarouselItems())
            );
        }
        return $fields;
    }


}

class HomePage_Controller extends Page_Controller
{
    public function AjaxResponse()
    {
        $data                               =   SaltedCache::read('HomeData', Session::get('lang'));

        if (empty($data)) {
            $data                           =   parent::AjaxResponse();
            $this->AttachStory($data, 'Zeffer', 'welcome');
            $this->AttachCarousel($data);
            $this->AttachCiders($data);
            $this->AttachStory($data, 'Story', 'story');
            $this->AttachStory($data, 'Sustainability', 'sustainability');
            $this->AttachTeam($data);
            $this->AttachAwards($data);
            $this->AttachContact($data);
            $this->AttachBuyNow($data);
            $this->AttachNews($data);
            SaltedCache::save('HomeData', Session::get('lang'), $data);
        }

        $csrf                               =   Session::get('SecurityID');
        $csrf                               =   !empty($csrf) ? $csrf : SecurityToken::getSecurityID();
        $data['csrf']                       =   $csrf;

        return $data;
    }

    public function AttachCiders(&$data)
    {
        if ($cider = Ciders::get()->first()) {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated = $cider->getTranslation('zh_Hans')) {
                    $cider                  =   $translated;
                }
            }
            $data['ciders']                 =   $cider->getData();
        }
    }

    public function AttachNews(&$data)
    {
        if (Session::get('lang') != 'zh_Hans') {
            if ($news = NewsLandingPage::get()->first()) {
                $data['news']               =   $news->getData();
            }
        }
    }

    private function AttachBuyNow(&$data)
    {
        if (Session::get('lang') != 'zh_Hans') {
            if ($buy = BuynowPage::get()->first()) {
                $data['buy']                =   $buy->getData();
            }
        }
    }

    private function AttachContact(&$data)
    {
        if ($contact = ContactPage::get()->first()) {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated = $contact->getTranslation('zh_Hans')) {
                    $contact                =   $translated;
                }
            }
            $data['contact']                =   $contact->getData();
        }
    }

    private function AttachCarousel(&$data)
    {
        $carousel_items                     =   $this->CarouselItems();
        if (Session::get('lang') == 'zh_Hans') {
            if ($translated = $this->getTranslation('zh_Hans')) {
                $carousel_items             =   $translated->CarouselItems();
            }
        }

        if ($carousel_items->count() > 0) {
            $data['carousel']           =   [];
            $carousel                   =   $carousel_items;
            foreach ($carousel as $item)
            {
                $data['carousel'][]     =   $item->getData();
            }
        }
    }

    private function AttachStory(&$data, $article_title, $key)
    {
        if ($story  =   Page::get()->filter(['Title' => $article_title])->first()) {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated = $story->getTranslation('zh_Hans')) {
                    $story              =   $translated;
                }
            }

            $data[$key]                 =   [
                                                'id'        =>  $story->ID,
                                                'title'     =>  $story->getSectionTitle(),
                                                'content'   =>  $story->Content,
                                                'hero'      =>  $story->ImageBreak()->exists() ? $story->ImageBreak()->SetWidth(1980)->URL : null,
                                                'video'     =>  !empty($story->VideoID) ?
                                                                [
                                                                    'video_url'     =>  $story->getVideoSource() . '?autoplay=1&rel=0',
                                                                    'video_cover'   =>  $story->getThumbnailURL()
                                                                ] :
                                                                null
                                            ];

        }
    }

    private function AttachTeam(&$data)
    {
        if ($team   =   People::get()->first()) {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated = $team->getTranslation('zh_Hans')) {
                    $team              =   $translated;
                }
            }
            $data['team']               =   $team->getData();
        }
    }

    private function AttachAwards(&$data)
    {
        if ($awards =   Awards::get()->first()) {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated = $awards->getTranslation('zh_Hans')) {
                    $awards             =   $translated;
                }
            }
            $data['awards']             =   $awards->getData();
        }
    }
}
