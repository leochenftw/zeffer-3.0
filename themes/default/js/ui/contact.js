var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    saltedjs            =   require('./gmap');
    constr              =   function(data)
    {
        this.contact    =   new Vue(
                            {
                                el      :   '#contact',
                                data    :   {
                                                title       :   data.title,
                                                content     :   data.content,
                                                hero        :   data.hero,
                                                lat         :   data.lat,
                                                lng         :   data.lng,
                                                key         :   data.api_key,
                                                methods     :   data.methods,
                                                socials     :   data.socials
                                            },
                                mounted :   function()
                                            {
                                                $('#contact').find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                                $(this.$el).find('#map').gmap();
                                            }
                            });

        return  this.contact;
    };
module.exports          =   constr;
