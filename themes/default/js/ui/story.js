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
                                            video       :   data ? (data.video ? data.video : null) : null,
                                            socials     :   socials,
                                            video_url   :   null
                                        },
                            mounted :   function()
                                        {
                                            if (!this.video) {
                                                $(id).find('.section-hero').attr('data-img-src', this.hero);
                                                $(id).find('.section-hero').jarallax(
                                                {
                                                    speed: 0.2
                                                });
                                            } else {
                                                $(id).find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                            }
                                        },
                            methods :   {
                                            play        :   function(e)
                                                            {
                                                                e.preventDefault();
                                                                this.video_url  =   this.video.video_url;
                                                            }
                                        }
                        });

        return  this.story;
    };
module.exports  =   constr;
