<?php
use SaltedHerring\Debugger;
use SaltedHerring\Utilities;
class Page extends SiteTree
{
    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'ImageBreakExtension'
    ];

    private static $db = [
        'AlternativeTitle'  =>  'Varchar(128)',
        'MenuToSection'     =>  'Varchar(128)'
    ];

    private static $has_one = [];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create(
                    'AlternativeTitle',
                    'Alternative title'
                )->setDescription('if an alt title is set, it will be used as the block title, when it\'s displayed on the homepage'),
                DropdownField::create(
                    'MenuToSection',
                    'Scroll to section',
                    $this->config()->sectionIDs
                )->setEmptyString('- select one -')
            ],
            'URLSegment'
        );
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function getSectionTitle()
    {
        return !empty($this->AlternativeTitle) ? $this->AlternativeTitle : $this->Title;
    }
}

class Page_Controller extends ContentController
{

    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * array (
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * );
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'ControllerAjaxExtension'
    ];

    public function init()
    {
        parent::init();

        if (empty(Session::get('lang'))) {

            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if ($lang == 'zh') {
                Session::set('lang', 'zh_Hans');
            } else {
                Session::set('lang', 'en_NZ');
            }
        }

        Requirements::block(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::block(SALTEDCROPPER_PATH . '/css/salted-cropper.css');
        Requirements::block("framework/javascript/ConfirmedPasswordField.js");
        Requirements::block("framework/css/ConfirmedPasswordField.css");

        // uncomment below to force login

        // if (empty(Member::currentUser())) {
        //     $raw    =   explode('?', $_SERVER['REQUEST_URI']);
        //     $url    =   trim($raw[0], '/');
        //     $url    =   explode('/', $url);
        //     if ($url[0] != 'signin' && $url[0] != 'Security') {
        //         return $this->redirect('/signin?BackURL=' . $this->request->getVar('url'));
        //     }
        // }

        if (!$this->request->isAjax()) {
            Requirements::combine_files(
                'scripts.js',
                $this->ClassName == 'HomePage' ?
                [
                    'themes/default/js/scripts.min.js'
                ] :
                [
                    'themes/default/node_modules/jquery/dist/jquery.min.js',
                    'themes/default/node_modules/jarallax/dist/jarallax.min.js',
                    'themes/default/js/components/salted-js/dist/salted-js.min.js',
                    'themes/default/js/custom.scripts.js'
                ]
            );
        }
    }

    protected function getSessionID()
    {
        return session_id();
    }

    protected function getHTTPProtocol()
    {
        $protocol = 'http';
        if (isset($_SERVER['SCRIPT_URI']) && substr($_SERVER['SCRIPT_URI'], 0, 5) == 'https') {
            $protocol = 'https';
        } elseif (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
            $protocol = 'https';
        }
        return $protocol;
    }

    protected function getCurrentPageURL()
    {
        return $this->getHTTPProtocol().'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    public function MetaTags($includeTitle = true)
    {
        $tags = parent::MetaTags();

        /**
         * Find title & replace with MetaTitle (if it exists).
         * */
        $title = '/(\<title\>)(.*)(\<\/title\>)/';
        preg_match($title, $tags, $matches);

        if (count($matches) > 0) {
            if ($this->MetaTitle) {
                $meta_title     =   $this->MetaTitle;
                if (Session::get('lang') == 'zh_Hans') {
                    $meta_title =   $this->getTranslation('zh_Hans')->MetaTitle;
                }
                $tags = preg_replace($title, '$1' . $meta_title . '$3', $tags);
            }
        }

        $charset = ContentNegotiator::get_encoding();
        $tags .= "<meta http-equiv=\"Content-type\" content=\"text/html; charset=$charset\" />\n";
        if($this->MetaKeywords) {
            $tags .= "<meta name=\"keywords\" content=\"" . Convert::raw2att($this->MetaKeywords) . "\" />\n";
        }
        if($this->ExtraMeta) {
            $tags .= $this->ExtraMeta . "\n";
        }

        if($this->URLSegment == 'home' && SiteConfig::current_site_config()->GoogleSiteVerificationCode) {
            $tags .= '<meta name="google-site-verification" content="'
                    . SiteConfig::current_site_config()->GoogleSiteVerificationCode . '" />';
        }

        // prevent bots from spidering the site whilest in dev.
        if(!Director::isLive()) {
            $tags .= "<meta name=\"robots\" content=\"noindex, nofollow, noarchive\" />\n";
        }

        $this->extend('MetaTags', $tags);

        return $tags;
    }

    public function getTheTitle()
    {
        return Convert::raw2xml(($this->MetaTitle) ? $this->MetaTitle : $this->Title);
    }

    public function getBodyClass()
    {
        return Utilities::sanitiseClassName($this->singular_name(),'-');
    }

    public function getLang()
    {
        // Debugger::inspect(Session::get('lang'));
        return str_replace('_', '-', Session::get('lang'));
    }

    public function getLogoIndex()
    {
        return ceil($this->Menu(1)->count() * 0.5 + 1);
    }

    public function getLangs($locale = null)
    {
        $flags      =   Config::inst()->get('Icons', 'flags');
        $options    =   [
                            'en-NZ'             =>  [
                                                        'title'     =>  'English',
                                                        'icon'      =>  $flags['en_NZ'],
                                                        'locale'    =>  'en_NZ',
                                                        'is_active' =>  $locale == 'en-NZ',
                                                        'link'      =>  !empty($this->Translations->filter(['Locale' => 'en_NZ'])->first()) ? $this->Translations->filter(['Locale' => 'en_NZ'])->first()->Link() : $this->Link()
                                                    ],
                            'zh-Hans'           =>  [
                                                        'title'     =>  '简体中文',
                                                        'icon'      =>  $flags['zh_Hans'],
                                                        'locale'    =>  'zh_Hans',
                                                        'is_active' =>  $locale == 'zh-Hans',
                                                        'link'      =>  !empty($this->Translations->filter(['Locale' => 'zh_Hans'])->first()) ? $this->Translations->filter(['Locale' => 'zh_Hans'])->first()->Link() : $this->Link()
                                                    ]
                        ];
        if (!empty($locale)) {
            return  ArrayData::create($options[$locale]);
        }

        return  ArrayList::create([
                    $options['en-NZ'],
                    $options['zh-Hans']
                ]);
    }
}
