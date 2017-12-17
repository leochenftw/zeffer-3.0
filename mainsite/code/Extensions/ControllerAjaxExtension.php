<?php
use SaltedHerring\Debugger;
class ControllerAjaxExtension extends DataExtension
{
    public function index()
    {
        $request                    =   $this->owner->request;
        if ($request->isAjax()) {
            $header =   $this->owner->getResponse();
            $header->addHeader('Content-Type', 'application/json');
            // $header->addHeader('Cache-Control', 'no-transform, public, max-age=300, s-maxage=900');

            if ($request->isPost()) {

                if ($lang = $request->postVar('lang')) {
                    Session::set('lang', $lang);
                }
            }

            return json_encode($this->owner->AjaxResponse());
        }

        return $this->owner->renderWith([$this->owner->ClassName, 'AjaxPage']);
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
                }
            }
            
            $nav[]                  =   [
                                            'title'     =>  $nav_item->MenuTitle,
                                            'url'       =>  $nav_item->Link(),
                                            'scrollto'  =>  $nav_item->MenuToSection,
                                            'is_active' =>  $nav_item->LinkOrCurrent() == 'current'
                                        ];
        }

        $flags                      =   Config::inst()->get('Icons', 'flags');
        $csrf                       =   Session::get('SecurityID');
        $csrf                       =   !empty($csrf) ? $csrf : SecurityToken::getSecurityID();
        return  [
                    'id'            =>  $this->owner->ID,
                    'url'           =>  $this->owner->Link() == '/home/' ? '/' : $this->owner->Link(),
                    'title'         =>  $this->owner->Title,
                    'content'       =>  $this->owner->Content,
                    'navigation'    =>  $nav,
                    'csrf'          =>  $csrf,
                    'subscribed'    =>  !empty(Session::get('Subscribed')),
                    'lang'          =>  str_replace('_', '-', Session::get('lang')),
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
