<section id="awards" class="section__text">
    <div class="section-hero" data-img-src="$ImageBreak.SetWidth(1980).URL"></div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">$Title</h2>
            <div class="content-content content">
                $Content
            </div>
            <div class="buy-options columns is-variable is-8">
                <div class="column is-half buy-options__region has-text-centered">
                    <h3 class="title is-2">Buy online - NZ</h3>
                    <div class="columns is-mobile is-multiline">
                        <% loop $NZOptions %>
                        <div class="column is-half has-text-centered">
                            <a href="$LinkURL"<% if $OpenInNewWindow %> target="_blank"<% end_if %> class="buy-option__link">
                                <img src="$OptionLogo.SetHeight(48).URL" height="96" alt="$OptionLogo.Title" /><br />
                                <span>$OptionLogo.Title</span>
                            </a>
                        </div>
                        <% end_loop %>
                    </div>
                </div>
                <div class="column is-half buy-options__region has-text-centered">
                    <h3 class="title is-2">Buy online - AUS</h3>
                    <div class="columns is-mobile is-multiline">
                        <% loop $AUSOptions %>
                        <div class="column is-half has-text-centered">
                            <a href="$LinkURL"<% if $OpenInNewWindow %> target="_blank"<% end_if %> class="buy-option__link">
                                <img src="$OptionLogo.SetHeight(48).URL" height="96" alt="$OptionLogo.Title" /><br />
                                <span>$OptionLogo.Title</span>
                            </a>
                        </div>
                        <% end_loop %>
                    </div>
                </div>
            </div>
            <div class="content">$Content</div>
        </div>
    </div>
</section>
