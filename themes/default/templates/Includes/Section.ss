<section id="$SectionID" class="section__text<% if not $toID %> to-section<% end_if %>"<% if $SectionID == 'news' || $SectionID == 'buy' %> v-if="title" <% end_if %>>
    <div v-if="hero" :class="{'section-hero': true, 'has-video': video}">
        <iframe v-if="video" :src="video_url" class="section-hero__video" frameborder="0" allowfullscreen="1" allow="encrypted-media" width="640" height="360"></iframe>
        <a v-if="video && !video_url" href="#" class="btn-play icon section-hero__button" v-on:click="play"><i class="fa fa-play-circle"></i></a>
    </div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">{{title}}</h2>
            <div class="content-content content" v-html="content"></div>
            <% if $SectionID == 'welcome' %>
            <% include Welcome %>
            <% end_if %>
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
    <div class="end-of-section"></div>
</section>
