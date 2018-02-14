$(document).ready(function(e)
{
    $('.section-hero').jarallax(
    {
        speed: 0.2
    });

    if ($('#map').length > 0) {
        $('#map').gmap();
    }

    $('#selector-trigger').on('click touchend', function(e)
    {
        $(this).parent().toggleClass('is-active');
    });
});
