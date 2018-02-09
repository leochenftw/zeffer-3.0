var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(data)
    {
        var owlIniter   =   function(owl, me)
                            {
                                owl.owlCarousel(
                                {
                                    items               :   1,
                                    lazyLoad            :   true,
                                    loop                :   true,
                                    nav                 :   true,
                                    dots                :   false,
                                    smartSpeed          :   1000,
                                    autoplay            :   true,
                                    autoplayTimeout     :   6000,
                                    autoplayHoverPause  :   true,
                                    navText             :   ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
                                }).on('loaded.owl.lazy', function(e)
                                {
                                    var slide   =   $(e.target).find('img[src="' + e.url + '"]').parent();
                                    slide.css('background-image', 'url(' + e.url + ')').parent().addClass('backgrounded');
                                }).on('drag.owl.carousel', function(e)
                                {
                                    me.pressed                  =   true;
                                    document.ontouchmove        =   function(e)
                                                                    {
                                                                        e.preventDefault();
                                                                    }
                                }).on('dragged.owl.carousel', function(e)
                                {
                                    me.pressed                  =   true;
                                    document.ontouchmove        =   function(e)
                                                                    {
                                                                        return true;
                                                                    }
                                }).on('translate.owl.carousel', function(e)
                                {
                                    me.pressed                  =   true;
                                }).on('translated.owl.carousel', function(e)
                                {
                                    if (!window.fingerdown) {
                                        me.pressed              =   false;
                                    }
                                }).trigger('drag.owl.carousel').trigger('dragged.owl.carousel');

                                $(me.$el).find('.btn-go-to').on('click touchend', function(e)
                                {
                                    e.preventDefault();
                                    if (me.pressed) return;

                                    var target  =   $(this).data('scrollto');
                                    target      =   $('#' + target);

                                    if (!target.hasClass('to-section')) {
                                        $.scrollTo(target, 1000, {axis: 'y'});
                                    } else {
                                        $.scrollTo(target.find('.section:eq(0)'), 1000, {axis: 'y'});
                                    }
                                });
                            };
        this.carousel   =   new Vue(
                            {
                                el              :   '#carousel',
                                data            :   {
                                                        carousel                :   data,
                                                        pressed                 :   false
                                                    },
                                beforeUpdate    :   function()
                                                    {
                                                        $('#carousel').trigger('destroy.owl.carousel');
                                                        $('#carousel .owl-item').remove();
                                                    },
                                updated         :   function()
                                                    {
                                                        owlIniter($('#carousel'), this);
                                                        $(this.$el).find('.owl-item').addClass('backgrounded');
                                                    },
                                mounted         :   function()
                                                    {
                                                        owlIniter($('#carousel'), this);
                                                    }
                            });

        return this.carousel;
    };

window.jQuery           =   $;
require('owl.carousel');
module.exports          =   constr;
