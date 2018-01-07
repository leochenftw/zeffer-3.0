var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    saltedjs            =   require('./gmap');
    constr              =   function(data)
    {
        this.contact    =   new Vue(
                            {
                                el      :   '#contact',
                                data    :   {
                                                title           :   data.title,
                                                content         :   data.content,
                                                hero            :   data.hero,
                                                lat             :   data.lat,
                                                lng             :   data.lng,
                                                key             :   data.api_key,
                                                methods         :   data.methods,
                                                socials         :   data.socials,
                                                fallback        :   data.fallback,
                                                social_label    :   data.social_label
                                            },
                                computed:   {
                                                get_style       :   function()
                                                                    {
                                                                        return 'background-image: url(' + this.fallback + ');';
                                                                    }
                                            },
                                mounted :   function()
                                            {
                                                $('#contact').find('.section-hero').attr('data-img-src', this.hero);
                                                $('#contact').find('.section-hero').jarallax(
                                                {
                                                    speed: 0.2
                                                });

                                                if ($(this.$el).find('#map').length > 0) {
                                                    $(this.$el).find('#map').gmap();
                                                }
                                            },
                                updated :   function()
                                            {
                                                if ($(this.$el).find('#map').length > 0) {
                                                    $(this.$el).find('#map').gmap();
                                                }
                                            },
                                methods :   {
                                                'make_class'    :   function(media)
                                                                    {
                                                                        return 'icon ' + media.media;
                                                                    }
                                            }
                            });

        return  this.contact;
    };
module.exports          =   constr;
