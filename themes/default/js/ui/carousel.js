var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(data)
    {
        this.carousel   =   new Vue(
                            {
                                el      :   '#carousel',
                                data    :   {
                                                carousel                :   data,
                                                pressed                 :   false
                                            },
                                beforeUpdate : function()
                                            {
                                                $('#carousel').trigger('destroy.owl.carousel');
                                                $('#carousel owl-item').remove();
                                            },
                                updated :   function()
                                            {
                                                var me                  =   this;

                                                $('#carousel').owlCarousel(
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
                                                    // me.pressed          =   true;
                                                }).on('dragged.owl.carousel', function(e)
                                                {
                                                    // me.pressed          =   true;
                                                }).on('translate.owl.carousel', function(e)
                                                {
                                                    me.pressed          =   true;
                                                }).on('translated.owl.carousel', function(e)
                                                {
                                                    me.pressed          =   false;
                                                });

                                                $(this.$el).find('.btn-go-to').on('click touchend', function(e)
                                                {
                                                    e.preventDefault();
                                                    console.log(me.pressed);
                                                    if (me.pressed) return;

                                                    var target  =   $(this).data('scrollto');
                                                    target      =   $('#' + target);

                                                    if (!target.hasClass('to-section')) {
                                                        $.scrollTo(target, 1000, {axis: 'y'});
                                                    } else {
                                                        $.scrollTo(target.find('.section:eq(0)'), 1000, {axis: 'y'});
                                                    }
                                                });
                                            },
                                mounted :   function() {
                                                var me                  =   this;
                                                $('#carousel').owlCarousel({
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
                                                    // me.pressed          =   true;
                                                }).on('dragged.owl.carousel', function(e)
                                                {
                                                    // me.pressed          =   true;
                                                }).on('translate.owl.carousel', function(e)
                                                {
                                                    me.pressed          =   true;
                                                }).on('translated.owl.carousel', function(e)
                                                {
                                                    me.pressed          =   false;
                                                });

                                                $(this.$el).find('.btn-go-to').on('click touchend', function(e)
                                                {
                                                    e.preventDefault();
                                                    console.log(me.pressed);

                                                    if (me.pressed) return;

                                                    var target  =   $(this).data('scrollto');
                                                    target      =   $('#' + target);

                                                    if (!target.hasClass('to-section')) {
                                                        $.scrollTo(target, 1000, {axis: 'y'});
                                                    } else {
                                                        $.scrollTo(target.find('.section:eq(0)'), 1000, {axis: 'y'});
                                                    }
                                                });
                                            }
                            });

        return this.carousel;
    };

window.jQuery           =   $;
require('owl.carousel');
module.exports          =   constr;
