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
                                                    if ($(window).scrollTop() >= 0) {
                                                        $('#header .navbar').addClass('mini');
                                                    }
                                                }
                                            });
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
                                                                return 'navbar-item order-' + (i + n);
                                                            },
                                            logo_class  :   function()
                                                            {
                                                                return 'navbar-item is-logo order-' + ((this.navitems.length * 0.5) + 1);
                                                            }
                                        }
                        });

        return  this.header;
    };
$(document).on('click touchend', '#selector-trigger', function(e)
{
    e.preventDefault();
    $(this).parent().toggleClass('is-active');
});

module.exports  =   constr;
