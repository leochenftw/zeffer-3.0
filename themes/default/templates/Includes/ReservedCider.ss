<div class="column is-8 cider__details is-reserved-range">
    <h3 class="cider__details__title info-line is-relative">$Title</h3>
    <p class="cider__details__style info-line is-relative">$ProductStyle</p>
    <p class="cider__details__vintage info-line is-relative">$ProudctVintage</p>
    <p class="cider__details__signature info-line is-relative">
        $ProductSignature.SetWidth(620)
    </p>
    <div class="content cider__details__content">$Content</div>
    <div class="columns cider__details__table is-marginless">
        <div class="is-2 column cider__details__vintage-col">$ProudctVintage</div>
        <div class="is-5 column cider__details__style-col">$ProductStyle</div>
        <div class="is-5 column cider__details__try-with-col">$TryMeWith</div>
    </div>
    <div class="columns is-mobile">
        <div class="is-6 column content cider__details__availability-col">
            <div class="with-title">
                <h4>Available in</h4>
                <div class="columns is-mobile is-marginless">
                    <% loop $myAvailabilities %>
                        <div class="has-text-centered column is-4">$Title</div>
                    <% end_loop %>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cider__alcohol column is-4 has-text-centered">$Alchohol% ALC</div>
