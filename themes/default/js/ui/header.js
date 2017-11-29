var Vue             =   require('vue/dist/vue.common'),
    constr          =   function(nav, lang)
    {
        this.header =   new Vue(
                        {
                            el      :   '#header',
                            data    :   {
                                            navitems    :   nav,
                                            languages   :   lang,
                                            active_lang :   null
                                        },
                            mounted :   function()
                                        {
                                            var me      =   this;
                                            this.languages.forEach(function(o)
                                            {
                                                if (o.is_active) {
                                                    me.active_lang =   o;
                                                    return false;
                                                }
                                            });
                                        },
                            updated :   function()
                                        {
                                            var me      =   this;
                                            this.languages.forEach(function(o)
                                            {
                                                if (o.is_active) {
                                                    me.active_lang =   o;
                                                    return false;
                                                }
                                            });
                                        }
                        });

        return  this.header;
    };
module.exports  =   constr;
