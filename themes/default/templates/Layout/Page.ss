<section id="main-content" class="section__text">
    <% if $URLSegment != 'Security' %>
        <div class="section-hero" data-img-src="$ImageBreak.SetWidth(1980).URL"></div>
    <% end_if %>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">$Title</h2>
            <div class="content-content content">
                $Content
                $Form
            </div>
        </div>
    </div>
</section>
