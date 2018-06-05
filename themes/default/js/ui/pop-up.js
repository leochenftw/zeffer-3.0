var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(data)
    {
        this.promo  =   new Vue(
                        {
                            el      :   '#pop-up-promo',
                            data    :   {
                                            data        :   data,
                                            show        :   true,
                                            read        :   false,
                                            no_more     :   false
                                        },
                            mounted :   function()
                                        {
                                            if (window.localStorage) {
                                                this.no_more                    =   window.localStorage.no_popup != "true" ?
                                                                                    false :
                                                                                    true;
                                            }

                                            this.show                           =   !this.no_more;
                                        },
                            updated :   function()
                                        {
                                            window.localStorage.no_popup        =   this.no_more;
                                        },
                            methods :   {
                                            close       :   function(e)
                                                            {
                                                                e.preventDefault();
                                                                this.show       =   false;

                                                            }
                                        }
                        });

        return  this.promo;
    };
module.exports  =   constr;
