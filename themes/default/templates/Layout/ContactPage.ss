<section id="contact" class="section__text">
    <div class="section-hero" data-img-src="$ImageBreak.SetWidth(1980).URL"></div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">$Title</h2>
            <div class="content-content content">
                $Content
            </div>
            <div class="contact columns">
                <div class="column is-7 contact__map">
                    <% if $FallbackMapImage %>
                    <div class="contact__map__fallback" style="background-image: url($FallbackMapImage.SetWidth(800).URL);"></div>
                    <% else %>
                    <div id="map-holder">
                        <div id="map" data-api="$APIKey" data-lat="$Latitude" data-lng="$Longitude" data-zoom="12"></div>
                    </div>
                    <% end_if %>
                </div>
                <div class="column is-5 contact__info">
                    <% if $ContactMethods %>
                    <ul class="contact__info__methods">
                        <% loop $ContactMethods %>
                        <li class="contact__info__method">
                            <h3 class="title is-6">$Title</h3>
                            <div class="content">$Content</div>
                        </li>
                        <% end_loop %>
                    </ul>
                    <% end_if %>
                    <h3 class="title is-6"><% if $ContentLocale == 'zh-Hans' %>社交平台<% else %>Chat with Zeffer online<% end_if %></h3>
                    <% if $SocialMedias %>
                    <ul class="contact__info__socials">
                        <% loop $SocialMedias %>
                        <li class="contact__info__social">
                            <a target="_blank" class="contact__info__social__link"<% if $Lightboxed %> data-lightbox="QR"<% end_if %> href="$LinkURL" title="$Title"><img src="$Icon" width="32" height="32" /></a>
                        </li>
                        <% end_loop %>
                    </ul>
                    <% end_if %>
                </div>
            </div>

        </div>
    </div>
</section>
