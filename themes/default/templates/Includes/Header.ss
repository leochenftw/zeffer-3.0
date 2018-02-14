<header id="header">
    <nav class="navbar is-transparent">
        <div class="navbar-brand">
            <div class="navbar-burger burger" data-target="main-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a class="navbar-logo" href="/">
                <% if $SiteConfig.SiteLogo %>$SiteConfig.SiteLogo.SetHeight(60)<% else %>$SiteConfig.Title<% end_if %>
            </a>
        </div>
        <div id="main-menu" class="navbar-menu">
            <a class="navbar-item is-logo order-$Top.LogoIndex" href="/">
                <% if $SiteConfig.SiteLogo %>$SiteConfig.SiteLogo.SetHeight(60)<% else %>$SiteConfig.Title<% end_if %>
            </a>
            <% loop Menu(1) %>
            <a class="navbar-item<% if LinkOrCurrent = current || $LinkOrSection = section %> is-active<% end_if %> order-$Pos" href="$Link">$MenuTitle.XML</a>
            <% end_loop %>
        </div>

        <div id="language-selector" class="navbar-item has-dropdown">
            <a class="navbar-link" id="selector-trigger">
                <span class="lang-icon">
                    <img src="$Top.getLangs($ContentLocale).icon" />
                </span>
            </a>
            <div class="navbar-dropdown is-boxed is-right">
                <% loop $Top.Langs %>
                <a href="$link" class="navbar-item btn-lang<% if $is_active %> is-active<% end_if %>" data-locale="$locale">
                    <span class="lang-icon">
                        <img src="$icon" />
                    </span>
                    <span class="lang-label">$title</span>
                </a>
                <% end_loop %>
            </div>
        </div>
    </nav>
</header>
