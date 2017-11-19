document.addEventListener("touchstart", function(){}, true);
if (typeof Handlebars !== 'undefined') {
    Handlebars.registerHelper('ifEqual', function(a, b, options) {
        if(a === b) {
            return options.fn(this);
        }
        return options.inverse(this);
    });
}

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
