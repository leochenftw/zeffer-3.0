var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(data)
    {
        this.awards =   new Vue(
                        {
                            el      :   '#awards',
                            data    :   {
                                            title   :   data.title,
                                            content :   data.content,
                                            hero    :   data.hero,
                                            awards  :   data.awards
                                        },
                            mounted :   function()
                                        {
                                            $('#awards').find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                        }
                        });

        return  this.awards;
    };
module.exports  =   constr;
