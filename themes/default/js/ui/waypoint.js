var $                   =   require('jquery'),
    waypoint            =   function(params)
    {
        this.element    =   $(params.element.$el).hasClass('to-section') ?  $('#' + params.element.$el.id).find('.section:eq(0)') : $('#' + params.element.$el.id);
        this.cbf        =   params.handler;
        this.offset     =   params.offset;

        this.top        =   0; //Math.ceil($(this.element).offset().top);
        this.bottom     =   0; //Math.ceil($(this.element).offset().top + $(this.element).outerHeight());
        this.title      =   params.title;

        var me          =   this,
            lastY       =   0;
        $(window).on('resize scroll', function(e)
        {
            if (!params.element.$el.id) return;
            me.element  =   $(params.element.$el).hasClass('to-section') ?  $('#' + params.element.$el.id).find('.section:eq(0)') : $('#' + params.element.$el.id);
            var offsets =   me.element.offset();

            me.top      =   Math.ceil(offsets.top);
            me.bottom   =   Math.ceil(offsets.top + $(me.element).outerHeight());

            var st      =   $(window).scrollTop() + me.offset,
                dir     =   $(window).scrollTop() > lastY ? 'down' : 'up';

            lastY       =   $(window).scrollTop();
            if (dir == 'down') {
                // console.log(st + ':' + me.top);
                if (st >= me.top) {
                    me.cbf(dir, me.title);
                }
            } else {
                if (st + $(window).height() * 2 >= me.bottom) {
                    me.cbf(dir, me.title);
                }
            }

        }).resize();

        return this;
    };

module.exports          =   waypoint;
