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
                                            video   :   data.video,
                                            awards  :   data.awards,
                                            labels  :   data.labels
                                        },
                            mounted :   function()
                                        {
                                            $('#awards').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#awards').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                        }
                        });

        return  this.awards;
    };
module.exports  =   constr;
