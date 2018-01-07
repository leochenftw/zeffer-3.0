var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(nav, lang)
    {
        this.header =   new Vue(
                        {
                            el      :   '#header',
                            data    :   {
                                            navitems    :   nav,
                                            languages   :   lang,
                                            active_lang :   null
                                        },
                            mounted :   function()
                                        {
                                            var me      =   this;
                                            this.languages.forEach(function(o)
                                            {
                                                if (o.is_active) {
                                                    me.active_lang =   o;
                                                    return false;
                                                }
                                            });

                                            $(window).scroll(function(e)
                                            {
                                                if ($('#header .navbar').hasClass('mini')) {
                                                    if ($(window).scrollTop() == 0) {
                                                        $('#header .navbar').removeClass('mini');
                                                    }
                                                } else {
                                                    if ($(window).scrollTop() > 0) {
                                                        $('#header .navbar').addClass('mini');
                                                    }
                                                }
                                            }).scrollTop(0).scroll();
                                        },
                            updated :   function()
                                        {
                                            var me      =   this;
                                            this.languages.forEach(function(o)
                                            {
                                                if (o.is_active) {
                                                    me.active_lang =   o;
                                                    return false;
                                                }
                                            });
                                        },
                            methods :   {
                                            make_class  :   function(i)
                                                            {
                                                                var n       =   1;
                                                                if (i >= (this.navitems.length - 1) / 2) {
                                                                    n       =   2;
                                                                }
                                                                return 'navbar-item order-' + (i + n) + ( this.navitems[i].is_active ? ' is-active' : '');
                                                            },
                                            logo_class  :   function()
                                                            {
                                                                return 'navbar-item is-logo order-' + (Math.floor(this.navitems.length * 0.5) + 1);
                                                            },
                                            go_to       :   function(id, e)
                                                            {
                                                                var target  =   $('#' + id);
                                                                if (target.hasClass('to-section')) {
                                                                    $.scrollTo(target.find('.section:eq(0)'), 1000, {axis: 'y', offset: -40});
                                                                } else {
                                                                    $.scrollTo(target, 1000, {axis: 'y', offset: -40});
                                                                }
                                                                // if (!has_hero) {
                                                                //     $.scrollTo(document.getElementById(id), 500, {axis: 'y'});
                                                                // } else {
                                                                //     $.scrollTo($('#' + id).find('.section:eq(0)')[0], 500, {axis: 'y'});
                                                                // }
                                                            }
                                        }
                        });

        return  this.header;
    };
require('jquery.scrollto');
$(document).on('click touchend', '#selector-trigger', function(e)
{
    e.preventDefault();
    $(this).parent().toggleClass('is-active');
});

module.exports  =   constr;
