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
                                                    items       :   4,
                                                    lazyLoad    :   true,
                                                    loop        :   true
                                                });
                                            }
                            });

        return this.carousel;
    };

window.jQuery           =   $;
require('owl.carousel');

module.exports          =   constr;
