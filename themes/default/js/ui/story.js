var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(id, data, socials)
    {
        this.story  =   new Vue(
                        {
                            el      :   id,
                            data    :   {
                                            title       :   data ? (data.title ? data.title : null) : null,
                                            content     :   data ? (data.content ? data.content : null) : null,
                                            hero        :   data ? (data.hero ? data.hero : null) : null,
                                            socials     :   socials
                                        },
                            mounted :   function()
                                        {
                                            // $(id).find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                            $(id).find('.section-hero').attr('data-img-src', this.hero);
                                            $(id).find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                        }
                        });

        return  this.story;
    };
module.exports  =   constr;
