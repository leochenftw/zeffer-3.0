var $                   =   require('jquery'),
    TweenMax            =   require('gsap'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(data)
    {
        this.ciders    =   new Vue(
                            {
                                el      :   '#ciders',
                                data    :   {
                                                title           :   data.title,
                                                content         :   data.content,
                                                ciders          :   data.list
                                            },
                                mounted :   function()
                                            {
                                                var me          =   this;
                                                for (var i = 0; i < this.ciders.length; i++)
                                                {
                                                    var dryness =   $('.dryness').eq(i).find('.column'),
                                                        tannin  =   $('.tannin').eq(i).find('.column'),
                                                        n       =   this.ciders[i].dryness,
                                                        j       =   this.ciders[i].tannin,
                                                        o       =   this.ciders[i];

                                                    dryness.each(function(i, el)
                                                    {
                                                        if (n > 0) {
                                                            $(this).find('.cross').append(me.icon(o));
                                                            n--;
                                                        }
                                                    });

                                                    tannin.each(function(i, el)
                                                    {
                                                        if (j > 0) {
                                                            $(this).find('.cross').append(me.icon(o));
                                                            j--;
                                                        }
                                                    });

                                                    o.availabilities        =   o.availabilities.split(',');
                                                }



                                                $(window).on('scroll resize', function(e)
                                                {
                                                    var n                   =   $(window).scrollTop();
                                                    $(me.$el).find('.cider__image').each(function(i, el)
                                                    {
                                                        var div             =   $(this),
                                                            img             =   $(this).find('img'),
                                                            diff            =   n - (div.offset().top - 52);
                                                        if (img.height() > 0 && img.height() < div.height()) {
                                                            if (diff > 0) {
                                                                if (img.height() + diff < div.height()) {
                                                                    TweenMax.to(img, 0, {'transform': 'translateY(' + diff + 'px)'});
                                                                } else {
                                                                    TweenMax.to(img, 0, {'transform': 'translateY(' + (div.height() - img.height()) + 'px)'});
                                                                }
                                                            } else {
                                                                img.removeAttr('style');
                                                            }
                                                        }
                                                    });
                                                }).scroll();

                                                var lastY                   =   0;
                                                $(window).on('scroll resize', function(e)
                                                {
                                                    var direct              =   $(window).scrollTop() > lastY ? 'down' : 'up',
                                                        t                   =   $('#ciders').offset().top - $(window).scrollTop(),
                                                        b                   =   $('#ciders').offset().top + $('#ciders').outerHeight() - $(window).scrollTop();

                                                    lastY                   =   $(window).scrollTop();

                                                    $(me.$el).find('.cider').each(function(i, el)
                                                    {
                                                        var cider           =   $(this),
                                                            scrollTop       =   $(window).scrollTop(),
                                                            top             =   cider.offset().top - scrollTop,
                                                            bottom          =   top + cider.outerHeight();

                                                        if (top <= 90 && bottom >= 0) {
                                                            $('.ciders__menu__item.is-active').removeClass('is-active');
                                                            $('.ciders__menu__item:eq(' + i + ')').addClass('is-active');
                                                            if (direct == 'up') {
                                                                if (b >= $(window).height()) {
                                                                    $('.ciders__menu').addClass('is-active');
                                                                }
                                                            } else {
                                                                $('.ciders__menu').addClass('is-active');
                                                            }
                                                        }
                                                    });

                                                    if (direct == 'down') {
                                                        if (b <= $(window).height() * 0.75) {
                                                            $('.ciders__menu').removeClass('is-active');
                                                        }
                                                    } else {
                                                        if (t >= $(window).height() * 0.125) {
                                                            $('.ciders__menu').removeClass('is-active');
                                                        }
                                                    }
                                                }).scroll();
                                            },
                                methods :   {
                                                go_to                       :   function(title)
                                                                                {
                                                                                    var target  =   $('.cider[data-cider="' + title + '"]');
                                                                                    $.scrollTo(target, 500, {axis: 'y', offset: -80});
                                                                                },
                                                make_class                  :   function(colour)
                                                                                {
                                                                                    return 'cider columns is-multiline' + (colour ? (' ' + colour) : '');
                                                                                },
                                                icon                        :   function(o)
                                                                                {
                                                                                    var i       =   Math.floor(Math.random() * o.x_icons.length),
                                                                                        url     =   o.x_icons[i].url,
                                                                                        img     =   $('<img />');
                                                                                        img.attr('src', url);
                                                                                    return img;
                                                                                }
                                            }
                            });

        return  this.ciders;
    };

require('waypoints/lib/noframework.waypoints');

module.exports          =   constr;
