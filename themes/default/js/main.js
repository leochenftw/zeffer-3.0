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

$.getJSON(window.location.pathname, function(data)
{
    $('body').addClass('ready');
    $('html').attr('lang', data.lang);

    var header  =   new Header(data.navigation, data.languages),
        caro    =   new Carousel(data.carousel),
        ciders  =   new Ciders(data.ciders),
        story   =   new Story('#story', data.story),
        sustain =   new Story('#sustainability', data.sustainability),
        awards  =   new Awards(data.awards),
        team    =   new Team(data.team),
        contact =   new Contact(data.contact);
        buy     =   new Buy(data.buy),
        news    =   new News(data.news),
        form    =   new Subscriber(data.csrf, data.subscribed);

        $(document).on('click', '.btn-lang', function(e)
        {
            e.preventDefault();
            if ($(this).hasClass('is-active')) return;
            var locale  =   $(this).data('locale');
            $.post(
                window.location.pathname,
                {
                    lang: locale
                },
                function(response)
                {
                    $('html').attr('lang', response.lang);
                    header.navigation   =   response.navigation;
                    header.languages    =   response.languages;
                    story.title         =   response.story.title;
                    story.content       =   response.story.content;
                    story.hero          =   response.story.hero;
                }
            );
        });
});

$(document).ready(function(e)
{
    $('#btn-mobile-menu').click(function(e)
    {
        e.preventDefault();
        var target  =   $('#' + $(this).data('target'));
        target.animate({height: 'toggle'});
        $(this).toggleClass('is-active');
    });
});
