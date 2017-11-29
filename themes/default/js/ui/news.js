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
                                            title       :   data.title,
                                            content     :   data.content,
                                            hero        :   data.hero,
                                            articles    :   data.articles,
                                            type        :   data.type
                                        },
                            mounted :   function()
                                        {
                                            $('#news').find('.section-hero').css('background-image', 'url(' + this.hero + ')');
                                        },
                            methods :   {
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
                                        }
                        });

        return  this.news;
    };
module.exports  =   constr;
