<section id="awards" class="section__text">
    <div class="section-hero" data-img-src="$ImageBreak.SetWidth(1980).URL"></div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">$Title</h2>
            <div class="content-content content">
                $Content
            </div>
            <div class="awards">
                <div class="columns award__heading">
                    <% if $ContentLocale == 'en-NZ' %><div class="column is-1">Year</div><div class="column">Award &amp; Class</div><div class="column">Competition</div><div class="column is-3">Cider</div>
                    <% else %>
                    <div class="column is-1">年度</div><div class="column">奖项及类别</div><div class="column">赛事名称</div><div class="column is-3">获奖产品</div>
                    <% end_if %>
                </div>
                <% loop $Awards %>
                <div class="columns award">
                    <div class="column is-1">$Year</div>
                    <div class="column">$AwardClass</div>
                    <div class="column">$Competition</div>
                    <div class="column is-3">$Cider</div>
                </div>
                <% end_loop %>
            </div>
        </div>
    </div>
</section>
