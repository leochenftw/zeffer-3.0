var $                   =   require('jquery'),
    Vue                 =   require('vue/dist/vue.common'),
    constr              =   function(site_name)
    {
        this.contact    =   new Vue(
                            {
                                el      :   '#footer',
                                data    :   {
                                                title           :   site_name,
                                            }
                            });

        return  this.contact;
    };
module.exports          =   constr;
