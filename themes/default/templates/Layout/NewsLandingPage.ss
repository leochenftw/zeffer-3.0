<section id="news" class="section__text">
    <div class="section-hero" data-img-src="$ImageBreak.SetWidth(1980).URL"></div>
    <div class="section">
        <div class="container">
            <h2 class="title is-2">$Title</h2>
            <div class="content-content content">
                $Content
            </div>
            <div class="news">
                <div class="content news__filters">
                <% if $AllCategories %>
                    <p class="news__categories"><strong>Categories</strong>: <% loop $AllCategories %><a href="$URL" class="news__category<% if $Current %> is-active<% end_if %>">$Title</a><% if not $Last %>, <% end_if %><% end_loop %></p>
                <% end_if %>
                <% if $AllTags %>
                    <p class="news__tags"><strong>Tags</strong>: <% loop $AllTags %><a href="$URL" class="news__tag<% if $Current %> is-active<% end_if %>">$Title</a><% if not $Last %>, <% end_if %><% end_loop %></p>
                <% end_if %>
                </div>
                <div class="news__items">
                    <% loop $Paginated  %>
                    <div class="news__item">
                        <div class="news__item__news columns is-variable is-6">
                            <div class="column is-narrow">
                                <div class="news__item__news__date-cube" datetime="$DatePublished">
                                    $Type
                                </div>
                            </div>
                            <div class="column">
                                <% if $Category %>
                                    <p class="news__item__news__category subtitle is-6"><a href="{$Top.Link}?category=$Category.Slug">$Category.Slug</a></p>
                                <% end_if %>
                                <h3 class="news__item__news__title title is-2">$Title</h3>
                                <p class="subtitle is-5">
                                    <time class="news__item__news__date" datetime="article.published">$DatePublished.Long</time>
                                </p>
                                <div class="news__item__news__content content">
                                    $Content
                                </div>
                                <% if $Tags %>
                                    <div class="news__item__blog__tags">
                                        Tagged:
                                        <% loop $Tags %>
                                            <a class="news__item__blog__tag" href="{$Top.Link}?tag=$Slug">$Title</a>
                                        <% end_loop %>
                                    </div>
                                <% end_if %>
                            </div>
                        </div>
                    </div>
                    <% end_loop %>
                    <% if $Paginated.MoreThanOnePage %>
                    <nav class="pagination">
                        <a href="$Paginated.PrevLink" class="pagination-previous"<% if not $Paginated.NotFirstPage %> disabled<% end_if %>>Prev</a>
                        <a href="$Paginated.NextLink" class="pagination-next"<% if not $Paginated.NotLastPage %> disabled<% end_if %>>Next</a>
                        <ul class="pagination-list" style="list-style: none; margin: 0;">
                        <% loop $Paginated.PaginationSummary %>
                            <% if $Link %>
                                <li style="margin-top: 0;"><a href="$Link" class="pagination-link<% if $CurrentBool %> is-current<% end_if %>">$PageNum</a></li>
                            <% else %>
                                <li><span class="pagination-ellipsis">&hellip;</span></li>
                            <% end_if %>
                        <% end_loop %>
                        </ul>
                    </nav>
                    <% end_if %>
                </div>
            </div>
        </div>
    </div>
</section>
