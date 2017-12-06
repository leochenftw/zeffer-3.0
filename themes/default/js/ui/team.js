var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(data)
    {
        this.team   =   new Vue(
                        {
                            el      :   '#team',
                            data    :   {
                                            title   :   data.title,
                                            content :   data.content,
                                            hero    :   data.hero,
                                            members :   data.members
                                        },
                            mounted :   function()
                                        {
                                            $('#team').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#team').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                        }
                        });

        return  this.team;
    };
module.exports  =   constr;
