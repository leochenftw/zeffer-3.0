var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(data)
    {
        this.buy =   new Vue(
                        {
                            el      :   '#buy',
                            data    :   {
                                            title       :   data.title,
                                            content     :   data.content,
                                            hero        :   data.hero,
                                            sec_cont    :   data.secondary_content,
                                            options     :   data.options
                                        },
                            mounted :   function()
                                        {
                                            $('#buy').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#buy').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                        }
                        });

        return  this.buy;
    };
module.exports  =   constr;
