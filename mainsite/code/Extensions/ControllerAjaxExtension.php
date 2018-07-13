<?php
use SaltedHerring\Debugger;
class ControllerAjaxExtension extends DataExtension
{
    public function index()
    {
        $request    =   $this->owner->request;
        $header     =   $this->owner->getResponse();

        // if (!Director::isLive()) {
            $header->addHeader('Access-Control-Allow-Origin', '*');
            $header->addHeader('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
            $header->addHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        // }

        if ($request->isAjax()) {
            $header->addHeader('Content-Type', 'application/json');
            // $header->addHeader('Cache-Control', 'no-transform, public, max-age=300, s-maxage=900');

            if ($request->isPost()) {

                if ($lang = $request->postVar('lang')) {
                    Session::set('lang', $lang);
                }
            }

            return json_encode($this->owner->AjaxResponse());
        }

        return $this->owner->renderWith([$this->owner->ClassName, $this->owner->ClassName == 'HomePage' ? 'AjaxPage' : 'Page']);
    }

    public function AjaxResponse()
    {
        $nav                        =   [];
        $navigation                 =   $this->owner->getMenu(1);
        foreach ($navigation as $nav_item)
        {
            if (Session::get('lang') == 'zh_Hans') {
                if ($translated     =   $nav_item->getTranslation('zh_Hans')) {
                    $nav_item       =   $translated;
                    $nav[]          =   [
                                            'title'         =>  $nav_item->MenuTitle,
                                            'url'           =>  $nav_item->Link(),
                                            'scrollto'      =>  $nav_item->MenuToSection,
                                            'is_active'     =>  $nav_item->LinkOrCurrent() == 'current'
                                        ];
                }
            } else {
                $nav[]              =   [
                                            'title'         =>  $nav_item->MenuTitle == 'Zeffer Cider from New Zealand' ? 'Home' : $nav_item->MenuTitle,
                                            'url'           =>  $nav_item->Link(),
                                            'scrollto'      =>  $nav_item->MenuToSection,
                                            'is_active'     =>  $nav_item->LinkOrCurrent() == 'current'
                                        ];
            }


        }

        $flags                      =   Config::inst()->get('Icons', 'flags');

        $site_config                =   SiteConfig::current_site_config();
        $owner                      =   $this->owner;
        if (Session::get('lang') == 'zh_Hans') {
            $site_config            =   $site_config->getTranslation('zh_Hans');
            $owner                  =   $owner->getTranslation('zh_Hans');
        }

        return  [
                    'id'            =>  !empty($owner) ? $owner->ID : null,
                    'url'           =>  $this->owner->Link() == '/home/' ? '/' : $this->owner->Link(),
                    'title'         =>  !empty($owner) ? $owner->Title : null,
                    'page_title'    =>  !empty($owner) ? $owner->MetaTitle : null,
                    'content'       =>  !empty($owner) ? $owner->Content : null,
                    'navigation'    =>  $nav,
                    'subscribed'    =>  !empty(Session::get('Subscribed')),
                    'lang'          =>  str_replace('_', '-', Session::get('lang')),
                    'site_name'     =>  $site_config->Title,
                    'site_version'  =>  $site_config->SiteVersion,
                    'site_logo'     =>  $site_config->SiteLogo()->exists() ?
                                        $site_config->SiteLogo()->SetHeight(60)->URL :
                                        null,
                    'sub_hero'      =>  $site_config->SubscriptionHero()->exists() ?
                                        $site_config->SubscriptionHero()->SetWidth(1980)->URL :
                                        null,
                    'alert'         =>  $site_config->TopStripePromo()->exists() ?
                                        [
                                            'title'         =>  $site_config->TopStripePromo()->Title,
                                            'url'           =>  $site_config->TopStripePromo()->getLinkURL()
                                        ] :
                                        null,
                    'pop_up'        =>  $site_config->getPopupData(),
                    'copyright'     =>  $site_config->Copyright,
                    'languages'     =>  [
                                            [
                                                'title'     =>  'English',
                                                'icon'      =>  $flags['en_NZ'],
                                                'locale'    =>  'en_NZ',
                                                'is_active' =>  Session::get('lang') == 'en_NZ'
                                            ],
                                            [
                                                'title'     =>  '简体中文',
                                                'icon'      =>  $flags['zh_Hans'],
                                                'locale'    =>  'zh_Hans',
                                                'is_active' =>  Session::get('lang') == 'zh_Hans'
                                            ]
                                        ]
                ];
    }
}
