<?php
use SaltedHerring\Debugger;
use SaltedHerring\Grid;
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
        $data                           =   parent::AjaxResponse();
        $this->AttachCarousel($data);
        $this->AttachStory($data, 'Story', 'story');
        $this->AttachStory($data, 'Sustainability', 'sustainability');
        $this->AttachTeam($data);
        $this->AttachAwards($data);
        $this->AttachContact($data);
        $this->AttachBuyNow($data);
        $this->AttachNews($data);

        return $data;
    }

    public function AttachNews(&$data)
    {
        if ($news = NewsLandingPage::get()->first()) {
            $data['news']                =   $news->getData();
        }
    }

    private function AttachBuyNow(&$data)
    {
        if ($buy = BuynowPage::get()->first()) {
            $data['buy']                =   $buy->getData();
        }
    }

    private function AttachContact(&$data)
    {
        if ($contact = ContactPage::get()->first()) {
            $data['contact']            =   $contact->getData();
        }
    }

    private function AttachCarousel(&$data)
    {
        if ($this->CarouselItems()->count() > 0) {
            $data['carousel']           =   [];
            $carousel                   =   $this->CarouselItems();
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
                                                'hero'      =>  $story->ImageBreak()->exists() ? $story->ImageBreak()->SetWidth(1980)->URL : null
                                            ];

        }
    }

    private function AttachTeam(&$data)
    {
        if ($team   =   People::get()->first()) {
            $data['team']               =   $team->getData();
        }
    }

    private function AttachAwards(&$data)
    {
        if ($awards =   Awards::get()->first()) {
            $data['awards']             =   $awards->getData();
        }
    }
}
