(function($){
    $.entwine('ss', function($) {
        $('#Form_EditForm_CategoryID_Holder').entwine(
        {
            onmatch: function(e)
            {
                var endpoint    =   $('#Form_EditForm_CategoryID').data('quickaddnew-action');
                endpoint        =   endpoint.split('?')[0];
                $('#Form_EditForm_CategoryID').data('quickaddnew-action', endpoint);
                $('#Form_EditForm_CategoryID').attr('data-quickaddnew-action', endpoint);
            }
        });
    });

}(jQuery));
