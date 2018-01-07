String.prototype.DoubleDigit = function() {
    var n = this.toFloat();

    return n < 10 ? ('0' + this) : this;
};
Number.prototype.DoubleDigit = function() {
    var s = this.toString();

    return this < 10 ? ('0' + s) : s;
};
var $               =   require('jquery'),
    Vue             =   require('vue/dist/vue.common'),
    months          =   ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    days            =   ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    constr          =   function(data)
    {
        this.news   =   new Vue(
                        {
                            el      :   '#news',
                            data    :   {
                                            title       :   data ? data.title : null,
                                            content     :   data ? data.content : null,
                                            hero        :   data ? data.hero : null,
                                            articles    :   data ? data.articles.list : null,
                                            next_page   :   data ? data.articles.pagination.url : null
                                        },
                            mounted :   function()
                                        {
                                            var me      =   this;
                                            $('#news').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#news').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });
                                            $(this.$el).find('button.button').on('click touchend', function(e)
                                            {
                                                e.preventDefault();
                                                var url =   $(this).data('next');
                                                $.get(
                                                    url,
                                                    function(data)
                                                    {
                                                        me.articles     =   me.articles.concat(data.articles.list);
                                                        me.next_page    =   data.articles.pagination.url;
                                                    }
                                                );
                                            });
                                        },
                            methods :   {
                                            make_link   :   function(filter, slug)
                                                            {
                                                                return '/news?' + filter + '=' + slug;
                                                            },
                                            parse_date  :   function(date)
                                                            {
                                                                var d   =   new Date(date);
                                                                return  {
                                                                            month   :   months[d.getMonth()],
                                                                            day     :   d.getDate().DoubleDigit()
                                                                        }
                                                            },
                                            friendly    :   function(date)
                                                            {
                                                                var d   =   new Date(date);
                                                                return days[d.getDay()] + ', ' + months[d.getMonth()] + ' ' + d.getDate().DoubleDigit() + ', ' + d.getFullYear();
                                                            }
                                        },
                            updated :   function()
                                        {
                                            var me      =   this;
                                            $('#news').find('.section-hero').attr('data-img-src', this.hero);
                                            $('#news').find('.section-hero').jarallax(
                                            {
                                                speed: 0.2
                                            });

                                            $(this.$el).find('button.button').on('click touchend', function(e)
                                            {
                                                e.preventDefault();
                                                var url =   $(this).data('next');
                                                $.get(
                                                    url,
                                                    function(data)
                                                    {
                                                        me.articles     =   me.articles.concat(data.articles.list);
                                                        me.next_page    =   data.articles.pagination.url;
                                                    }
                                                );
                                            });
                                        }
                        });

        return  this.news;
    };
module.exports  =   constr;
