var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(data)
    {
        this.buy =   new Vue(
                        {
                            el      :   '#buy',
                            data    :   {
                                            title       :   data ? data.title : null,
                                            content     :   data ? data.content : null,
                                            hero        :   data ? data.hero : null,
                                            sec_cont    :   data ? data.secondary_content : null,
                                            options     :   data ? data.options : null
                                        },
                            mounted :   function()
                                        {
                                            $('#buy').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#buy').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                        },
                            updated :   function()
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
