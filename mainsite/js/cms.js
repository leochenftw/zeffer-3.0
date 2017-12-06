(function($){
    $.entwine('ss', function($) {
        $('#Form_ItemEditForm_ReserveRange').entwine(
        {
            onmatch: function(e)
            {
                $('#Form_ItemEditForm_ReserveRange').change(function(e)
                {
                    if ($(this).prop('checked')) {
                        $('#Form_ItemEditForm_Subtitle_Holder, #Form_ItemEditForm_TitleImage_Holder, #Form_ItemEditForm_See_Holder, #Form_ItemEditForm_Smell_Holder, #Form_ItemEditForm_Taste_Holder, #Form_ItemEditForm_Dryness_Holder, #Form_ItemEditForm_Tannin_Holder, #Form_ItemEditForm_CiderColour_Holder, #Form_ItemEditForm_Xs_Holder').hide();
                        $('#Form_ItemEditForm_ProductStyle_Holder, #Form_ItemEditForm_ProudctVintage_Holder, #Form_ItemEditForm_ProductSignature_Holder').show();
                    } else {
                        $('#Form_ItemEditForm_ProductStyle_Holder, #Form_ItemEditForm_ProudctVintage_Holder, #Form_ItemEditForm_ProductSignature_Holder').hide();
                        $('#Form_ItemEditForm_Subtitle_Holder, #Form_ItemEditForm_TitleImage_Holder, #Form_ItemEditForm_See_Holder, #Form_ItemEditForm_Smell_Holder, #Form_ItemEditForm_Taste_Holder, #Form_ItemEditForm_Dryness_Holder, #Form_ItemEditForm_Tannin_Holder, #Form_ItemEditForm_CiderColour_Holder, #Form_ItemEditForm_Xs_Holder').show();
                    }
                }).change();

                $('.ui-tabs-nav .ui-tabs-active  a.ui-tabs-anchor').click();
            }
        });
    });

    $(document).on('click', '.ui-tabs-nav a.ui-tabs-anchor', function(e)
    {
        if ($('#Form_ItemEditForm_ReserveRange').length > 0) {
            var panel   =   $('.ui-tabs-panel:visible');
            panel.prepend($('#Form_ItemEditForm_ReserveRange_Holder'));
        }
    });
}(jQuery));
