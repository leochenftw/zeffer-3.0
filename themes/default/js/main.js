var $           =   require('jquery');
    Header      =   require('./ui/header'),
    Carousel    =   require('./ui/carousel'),
    Ciders      =   require('./ui/ciders'),
    Story       =   require('./ui/story'),
    Awards      =   require('./ui/awards'),
    Team        =   require('./ui/team'),
    Contact     =   require('./ui/contact'),
    Buy         =   require('./ui/buy'),
    News        =   require('./ui/news'),
    Subscriber  =   require('./ui/subscribe-form'),
    lightbox    =   require('lightbox2'),
    Waypoint    =   require('./ui/waypoint'),
    jarallax    =   require('jarallax'),
    Footer      =   require('./ui/footer');

$.getJSON(window.location.pathname, function(data)
{
    $('html').attr('lang', data.lang);

    var header          =   new Header(data.navigation, data.languages),
        welcome         =   new Story('#welcome', data.welcome),
        caro            =   new Carousel(data.carousel),
        ciders          =   new Ciders(data.ciders, header.navitems),
        story           =   new Story('#story', data.story),
        sustain         =   new Story('#sustainability', data.sustainability),
        awards          =   new Awards(data.awards),
        team            =   new Team(data.team),
        contact         =   new Contact(data.contact);
        buy             =   new Buy(data.buy),
        news            =   new News(data.news),
        form            =   new Subscriber(data.csrf, data.subscribed, data.sub_hero),
        nav_items       =   data.navigation,
        footer          =   new Footer(data.copyright),
        activate        =   function(title, direction)
                            {
                                nav_items.forEach(function(item)
                                {
                                    // console.log(item.title + ': ' + title);
                                    if (item.title == title) {
                                        item.is_active  =   true;
                                        if (title == 'Ciders' || title == '全部产品') {
                                            if (direction && direction == 'up') {
                                                $('.ciders__menu').addClass('is-active');
                                            }
                                        } else {
                                            $('.ciders__menu').removeClass('is-active');
                                        }
                                    } else {
                                        item.is_active  =   false;
                                    }
                                });
                            },
        point_maker     =   function(section, title)
                            {
                                var wp      =   new Waypoint(
                                                {
                                                    element     :   section,
                                                    title       :   title,
                                                    handler     :   function(direction, title)
                                                                    {
                                                                        activate(title, direction);
                                                                    },
                                                    offset      :   80
                                                });
                                return wp;
                            };

    var anchor_ciders   =   point_maker(ciders, data.lang == 'zh-Hans' ? '全部产品' : 'Ciders'),
        anchor_story    =   point_maker(story, data.lang == 'zh-Hans' ? '企业文化' : 'Story'),
        anchor_sustain  =   point_maker(sustain, data.lang == 'zh-Hans' ? '环保理念' : 'Sustainability'),
        anchor_awards   =   point_maker(awards, data.lang == 'zh-Hans' ? '荣获奖项' : 'Awards'),
        anchor_contact  =   point_maker(contact, data.lang == 'zh-Hans' ? '联系我们' : 'Contact'),
        anchor_buy      =   point_maker(buy, data.lang == 'zh-Hans' ? '在线购买' : 'Buy now'),
        anchor_news     =   point_maker(news, data.lang == 'zh-Hans' ? '最新动态' : 'News');

    form.lang                   =   data.lang;
    $('title').html(data.page_title);

    if (data.lang == 'zh-Hans') {
        contact.social_label    =   '社交平台';
        ciders.labels           =   {
                                        see                     :   '视觉',//'色泽',
                                        smell                   :   '嗅觉',//'气味',
                                        taste                   :   '味觉',//'品味',
                                        trywith                 :   '佐餐推荐',//'佐餐',
                                        dryness                 :   '甜度',//'干度',
                                        tannin                  :   '单宁含量',//'单宁',
                                        avail                   :   '容量'//'包装'
                                    };
        form.title              =   '加入订阅';
        form.content            =   '';
        form.message            =   '您已经加入了我们的订阅计划 :)';
    } else {
        contact.social_label    =   'Chat with Zeffer online';
        ciders.labels           =   {
                                        see                     :   'See',
                                        smell                   :   'Smell',
                                        taste                   :   'Taste',
                                        trywith                 :   'Try me with',
                                        dryness                 :   'Dryness',
                                        tannin                  :   'Tannin',
                                        avail                   :   'Available in'
                                    };
        form.title              =   'Subscribe to our newsletter';
        form.content            =   '<p>You can also sign up to our newsletter. We promise not to spam you! We’ll only be sharing juicy news, upcoming cider releases and giveaways (so just the good stuff).</p>';
        form.message            =   'You have already subscribed to our newsletter :)';
    }

    $(window).on('scroll resize', function(e)
    {
        if ($(window).scrollTop() <= $(window).height() * 0.8) {
            activate($('body').hasClass('zh-hans') ? '吉馥首页' : 'Home');
        }
    }).scroll();

    $(document).on('click', '.btn-lang', function(e)
    {
        e.preventDefault();
        if ($(this).hasClass('is-active')) return;
        var locale                  =   $(this).data('locale');
        $('body').removeClass('ready');
        $.post(
            window.location.pathname,
            {
                lang: locale
            },
            function(response)
            {
                nav_items                   =   response.navigation;
                $('#language-selector').removeClass('is-active');
                $('html').attr('lang', response.lang);
                $('body').removeClass('en-nz').removeClass('zh-hans').addClass(response.lang.toLowerCase());

                welcome.title               =   response.welcome.title;
                welcome.content             =   response.welcome.content;
                welcome.hero                =   response.welcome.hero;

                header.navitems             =   response.navigation;
                header.languages            =   response.languages;
                caro.carousel               =   response.carousel;
                ciders.title                =   response.ciders.title;
                ciders.content              =   response.ciders.content;
                ciders.ciders               =   response.ciders.list;
                // header.navitems
                story.title                 =   response.story.title;
                story.content               =   response.story.content;
                story.hero                  =   response.story.hero;
                team.title                  =   response.team.title;
                team.content                =   response.team.content;
                team.hero                   =   response.team.hero;
                team.members                =   response.team.members;
                sustain.title               =   response.sustainability.title;
                sustain.content             =   response.sustainability.content;
                sustain.hero                =   response.sustainability.hero;
                awards.title                =   response.awards.title;
                awards.content              =   response.awards.content;
                awards.hero                 =   response.awards.hero;
                awards.labels               =   response.awards.labels;
                awards.awards               =   response.awards.awards;
                contact.title               =   response.contact.title;
                contact.content             =   response.contact.content;
                contact.hero                =   response.contact.hero;
                contact.lat                 =   response.contact.lat;
                contact.lng                 =   response.contact.lng;
                contact.key                 =   response.contact.api_key;
                contact.fallback            =   response.contact.fallback;
                contact.methods             =   response.contact.methods;
                contact.socials             =   response.contact.socials;

                news.title                  =   response.news ? response.news.title : null;
                news.content                =   response.news ? response.news.content : null;
                news.hero                   =   response.news ? response.news.hero : null;
                news.articles               =   response.news ? response.news.articles.list : null;
                news.next_page              =   response.news ? response.news.articles.pagination.url : null;
                buy.title                   =   response.buy ? response.buy.title : null;
                buy.content                 =   response.buy ? response.buy.content : null;
                buy.hero                    =   response.buy ? response.buy.hero : null;
                buy.sec_cont                =   response.buy ? response.buy.secondary_content : null;
                buy.options                 =   response.buy ? response.buy.options : null;

                form.lang                   =   response.lang;
                form.hero                   =   response.sub_hero;

                if (response.lang == 'zh-Hans') {
                    contact.social_label    =   '社交平台';
                    ciders.labels           =   {
                                                    see                     :   '色泽',
                                                    smell                   :   '气味',
                                                    taste                   :   '品味',
                                                    trywith                 :   '佐餐',
                                                    dryness                 :   '干度',
                                                    tannin                  :   '单宁',
                                                    avail                   :   '包装'
                                                };
                    form.title              =   '加入订阅';
                    form.content            =   '';
                    form.message            =   '您已经加入了我们的订阅计划 :)';

                    anchor_ciders.title     =   '全部产品';
                    anchor_story.title      =   '企业文化';
                    anchor_sustain.title    =   '环保理念';
                    anchor_awards.title     =   '荣获奖项';
                    anchor_contact.title    =   '联系我们';
                    anchor_buy.title        =   '在线购买';
                    anchor_news.title       =   '最新动态';
                    anchor_buy.suspend      =   true;
                    anchor_news.suspend     =   true;
                } else {
                    contact.social_label    =   'Chat with Zeffer online';
                    ciders.labels           =   {
                                                    see                     :   'See',
                                                    smell                   :   'Smell',
                                                    taste                   :   'Taste',
                                                    trywith                 :   'Try me with',
                                                    dryness                 :   'Dryness',
                                                    tannin                  :   'Tannin',
                                                    avail                   :   'Available in'
                                                };
                    form.title              =   'Subscribe to our newsletter';
                    form.content            =   '<p>You can also sign up to our newsletter. We promise not to spam you! We’ll only be sharing juicy news, upcoming cider releases and giveaways (so just the good stuff).</p>';
                    form.message            =   'You have already subscribed to our newsletter :)';

                    anchor_ciders.title     =   'Ciders',
                    anchor_story.title      =   'Story',
                    anchor_sustain.title    =   'Sustainability',
                    anchor_awards.title     =   'Awards',
                    anchor_contact.title    =   'Contact',
                    anchor_buy.title        =   'Buy now',
                    anchor_news.title       =   'News';
                    anchor_buy.suspend      =   false;
                    anchor_news.suspend     =   false;
                }

                footer.title                =   response.copyright;

                $('title').html(response.page_title);

                $.scrollTo($('body'), 100, {axis: 'y', onAfter: function()
                {
                    $('body').addClass('ready');
                }});

                activate($('body').hasClass('zh-hans') ? '吉馥首页' : 'Home');
            }
        );
    });

    $(window).scrollTop(0).scroll();
    $('body').addClass('ready').removeClass('en-nz').removeClass('zh-hans').addClass(data.lang.toLowerCase());
});

$(document).on('touchstart', function(e)
{
    window.fingerdown   =   true;
});

$(document).on('touchend', function(e)
{
    window.fingerdown   =   false;
});
