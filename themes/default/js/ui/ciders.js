var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(data)
    {
        this.ciders    =   new Vue(
                            {
                                el      :   '#ciders',
                                data    :   {
                                                title           :   data.title,
                                                content         :   data.content,
                                                ciders          :   data.list
                                            },
                                mounted :   function()
                                            {
                                                var me          =   this;
                                                for (var i = 0; i < this.ciders.length; i++)
                                                {
                                                    var dryness =   $('.dryness').eq(i).find('.column'),
                                                        tannin  =   $('.tannin').eq(i).find('.column'),
                                                        n       =   this.ciders[i].dryness,
                                                        j       =   this.ciders[i].tannin,
                                                        o       =   this.ciders[i];

                                                    dryness.each(function(i, el)
                                                    {
                                                        if (n > 0) {
                                                            $(this).find('.cross').append(me.icon(o));
                                                            n--;
                                                        }
                                                    });

                                                    tannin.each(function(i, el)
                                                    {
                                                        if (j > 0) {
                                                            $(this).find('.cross').append(me.icon(o));
                                                            j--;
                                                        }
                                                    });

                                                    o.availabilities        =   o.availabilities.split(',');
                                                }
                                            },
                                methods :   {
                                                icon    :   function(o)
                                                            {
                                                                var i       =   Math.floor(Math.random() * o.x_icons.length),
                                                                    url     =   o.x_icons[i].url,
                                                                    img     =   $('<img />');
                                                                    img.attr('src', url);
                                                                return img;
                                                            }
                                            }
                            });

        return  this.ciders;
    };
module.exports          =   constr;
