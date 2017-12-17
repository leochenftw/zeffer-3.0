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
    jarallax    =   require('jarallax');

window.yPos     =   (typeof window.localStorage) != undefined ? window.localStorage.yPos : 0;

require('waypoints/lib/noframework.waypoints');

$.getJSON(window.location.pathname, function(data)
{
    $('html').attr('lang', data.lang);

    var header          =   new Header(data.navigation, data.languages),
        caro            =   new Carousel(data.carousel),
        ciders          =   new Ciders(data.ciders, header.navitems),
        story           =   new Story('#story', data.story),
        sustain         =   new Story('#sustainability', data.sustainability),
        awards          =   new Awards(data.awards),
        team            =   new Team(data.team),
        contact         =   new Contact(data.contact);
        buy             =   new Buy(data.buy),
        news            =   new News(data.news),
        form            =   new Subscriber(data.csrf, data.subscribed),
        activate        =   function(title, direction)
                            {
                                data.navigation.forEach(function(item)
                                {
                                    if (item.title == title) {
                                        item.is_active  =   true;
                                        if (title == 'Ciders') {
                                            if (direction && direction == 'down') {
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
                                var to_sec  =   $(section.$el).hasClass('to-section'),
                                    el      =   to_sec ? $(section.$el).find('.section:eq(0)')[0] : $(section.$el)[0];
                                    top     =   new Waypoint(
                                                {
                                                    element     :   el,
                                                    handler     :   function(direction)
                                                                    {
                                                                        activate(title, direction);
                                                                    },
                                                    offset      :   40
                                                }),
                                    bottom  =   null;

                                if ($(section.$el).find('.end-of-section').length > 0) {
                                    bottom  =   new Waypoint(
                                                {
                                                    element     :   $(section.$el).find('.end-of-section')[0],
                                                    handler     :   function(direction)
                                                                    {
                                                                        if (section.$el.id == 'ciders') {
                                                                            if (direction == 'up') {
                                                                                activate(title, direction);
                                                                            }
                                                                        } else {
                                                                            activate(title, direction);
                                                                        }
                                                                    },
                                                    offset      :   40
                                                });
                                }

                                return  {
                                            el                  :   el,
                                            top                 :   top,
                                            bottom              :   bottom
                                        }
                            };

    point_maker(ciders, 'Ciders');
    point_maker(story, 'Story');
    point_maker(sustain, 'Sustainability');
    point_maker(awards, 'Awards');
    point_maker(contact, 'Contact');
    point_maker(buy, 'Buy now');
    point_maker(news, 'News');

    $(window).on('scroll resize', function(e)
    {
        if ($(window).scrollTop() <= $(window).height() * 0.8) {
            activate('Home');
        }
        window.yPos                 =   $(window).scrollTop();
        window.localStorage.yPos    =   window.yPos;
    }).scroll();

    $(document).on('click', '.btn-lang', function(e)
    {
        e.preventDefault();
        if ($(this).hasClass('is-active')) return;
        var locale                  =   $(this).data('locale');
        $.post(
            window.location.pathname,
            {
                lang: locale
            },
            function(response)
            {
                $('#language-selector').removeClass('is-active');
                $('html').attr('lang', response.lang);
                $('body').addClass(response.lang.toLowerCase());
                header.navitems     =   response.navigation;
                header.languages    =   response.languages;
                story.title         =   response.story.title;
                story.content       =   response.story.content;
                story.hero          =   response.story.hero;
                sustain.title       =   response.sustainability.title;
                sustain.content     =   response.sustainability.content;
                sustain.hero        =   response.sustainability.hero;
                awards.title        =   response.awards.title;
                awards.content      =   response.awards.content;
                awards.hero         =   response.awards.hero;
                awards.labels       =   response.awards.labels;
                awards.awards       =   response.awards.awards;
            }
        );
    });

    $(window).scrollTop(0).scroll();
    $('body').addClass('ready').addClass(data.lang.toLowerCase());
});

$(document).ready(function(e)
{
    $(window).scrollTop(0);
    $('#btn-mobile-menu').click(function(e)
    {
        e.preventDefault();
        var target  =   $('#' + $(this).data('target'));
        target.animate({height: 'toggle'});
        $(this).toggleClass('is-active');
    });
});
