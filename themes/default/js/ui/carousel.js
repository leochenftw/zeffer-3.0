var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(data)
    {
        this.carousel   =   new Vue(
                            {
                                el      :   '#carousel',
                                data    :   {
                                                carousel        :   data
                                            },
                                mounted :   function() {
                                                $('#carousel').owlCarousel({
                                                    items       :   1,
                                                    lazyLoad    :   true,
                                                    loop        :   true
                                                }).on('loaded.owl.lazy', function(e)
                                                {
                                                    var slide   =   $(e.target).find('img[src="' + e.url + '"]').parent();
                                                    slide.css('background-image', 'url(' + e.url + ')').addClass('backgrounded');
                                                });
                                            }
                            });

        return this.carousel;
    };

window.jQuery           =   $;
require('owl.carousel');

module.exports          =   constr;
