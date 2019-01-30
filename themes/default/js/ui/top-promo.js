var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(alert_data)
    {
        this.promo  =   new Vue(
                        {
                            el      :   '#alert',
                            data    :   {
                                            alert       :   alert_data,
                                            show        :   false,
                                            read        :   false
                                        },
                            mounted :   function()
                                        {
                                            this.add_class();
                                        },
                            updated :   function()
                                        {
                                            this.add_class();
                                        },
                            methods :   {
                                            add_class   :   function()
                                                            {
                                                                if (this.alert && this.show) {
                                                                    $('body').addClass('has-alert');
                                                                } else {
                                                                    $('body').removeClass('has-alert');
                                                                }
                                                            },
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
