<header id="header">
    <nav class="navbar is-transparent">
        <div class="navbar-brand hide">
            <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <a class="navbar-item" href="/">
                <% if $SiteConfig.SiteLogo %>$SiteConfig.SiteLogo.SetHeight(75)<% else %>$SiteConfig.Title<% end_if %>
            </a>
            <a v-for="navitem in navitems" class="navbar-item" :href="navitem.url">{{navitem.title}}</a>
            <div class="navbar-item has-dropdown is-active" v-if="languages">
                <a v-if="active_lang" class="navbar-link">
                    <span class="lang-icon">
                        <img :src="active_lang.icon" />
                    </span>
                    {{active_lang.title}}
                </a>
                <div class="navbar-dropdown">
                    <a v-for="language in languages" :class="{'navbar-item': true, 'btn-lang': true, 'is-active': language.is_active}" :data-locale="language.locale">
                        <span class="lang-icon">
                            <img :src="language.icon" />
                        </span>
                        {{language.title}}
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
