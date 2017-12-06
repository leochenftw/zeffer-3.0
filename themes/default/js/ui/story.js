var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(id, data)
    {
        this.story  =   new Vue(
                        {
                            el      :   id,
                            data    :   {
                                            title   :   data.title,
                                            content :   data.content,
                                            hero    :   data.hero
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
