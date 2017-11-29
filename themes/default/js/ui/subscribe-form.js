var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    constr          =   function(csrf, subscribed)
    {
        this.form =   new Vue(
                        {
                            el      :   '#subscription',
                            data    :   {
                                            title           :   'Subscribe to our newsletter',
                                            content         :   '<p>You can also sign up to our newsletter. We promise not to spam you! We’ll only be sharing juicy news, upcoming cider releases and giveaways (so just the good stuff).</p>',
                                            csrf            :   csrf,
                                            hero            :   null,
                                            completed       :   subscribed,
                                            message         :   'You have already subscribed to our newsletter :)'
                                        },
                            mounted :   function()
                                        {
                                            var me          =   this,
                                                the_form    =   $(this.$el).find('form');

                                            the_form.ajaxSubmit(
                                            {
                                                onstart     :   function()
                                                                {
                                                                    the_form.find('.button').addClass('is-loading');
                                                                },
                                                success     :   function(data)
                                                                {
                                                                    me.completed    =   true;
                                                                    me.message      =   data.message;
                                                                },
                                                done        :   function(data)
                                                                {
                                                                    the_form.find('.button').removeClass('is-loading');
                                                                },
                                                fail        :   function(data)
                                                                {
                                                                    alert(data.responseJSON.message);
                                                                }
                                            });
                                        }
                        });

        return  this.form;
    };


(function($) {
    $.fn.ajaxSubmit = function(cbf) {
        var self            =   $(this),
            endpoint        =   $(this).attr('action'),
            method          =   $(this).attr('method'),
            lockdown        =    false,
            callbacks       =   $.extend({
                                    validator: function() { return true; },
                                    onstart: function() {},
                                    success: function(response) {},
                                    fail: function(response) {},
                                    done: function(response) {}
                                }, cbf);

        $(this).submit(function(e){
            e.preventDefault();
            e.stopPropagation();

            if (!callbacks.validator()) {
                return false;
            }

            if (lockdown) {
                return false;
            }

            lockdown = true;
            var formData    =   new FormData($(this)[0]);
            callbacks.onstart();
            $.ajax({
                url: endpoint,
                type: method,
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(callbacks.success).fail(callbacks.fail).always(function(response) {
                lockdown = false;
                callbacks.done(response);
            });
        });
    };
 })(jQuery);
module.exports  =   constr;
