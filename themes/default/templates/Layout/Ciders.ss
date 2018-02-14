<section id="ciders">
    <div class="section">
        <div class="container">
            <div class="ciders__heading">
                <h2 class="title is-2">$Title</h2>
                <div class="content">$Content</div>
            </div>
            <% if $Ciders.Count > 0 %>
            <div class="ciders">
            <% loop $Ciders %>
                <div class="cider columns is-multiline $CiderColour.LowerCase" data-cider="$Title">
                    <div class="column is-4 cider__image">
                        <% if $ProductImage %>
                        <img src="$ProductImage.SetWidth(620).URL" />
                        <% else %>
                        <p>&lt;This cider has no image&gt;</p>
                        <% end_if %>
                    </div>
                    <% if $ReserveRange %>
                    <% include ReservedCider %>
                    <% else %>
                    <% include RegularCider %>
                    <% end_if %>
                </div>
            <% end_loop %>
            </div>
            <% end_if %>
        </div>
    </div>
</section>
