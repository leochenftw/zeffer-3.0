<section id="$SectionID" class="section__text">
    <div v-if="hero" class="section-hero"></div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">{{title}}</h2>
            <div class="content" v-html="content"></div>
            <% if $SectionID == 'team' %>
            <% include Team %>
            <% end_if %>
            <% if $SectionID == 'awards' %>
            <% include Awards %>
            <% end_if %>
            <% if $SectionID == 'contact' %>
            <% include Contact %>
            <% end_if %>
            <% if $SectionID == 'buy' %>
            <% include Buy %>
            <% end_if %>
            <% if $SectionID == 'news' %>
            <% include News %>
            <% end_if %>
            <% if $SectionID == 'subscription' %>
            <% include Subscription %>
            <% end_if %>
        </div>
    </div>
</section>
