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
                                            $(id).find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                        }
                        });

        return  this.story;
    };
module.exports  =   constr;
