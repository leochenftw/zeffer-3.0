<header id="header">
    <nav class="navbar is-transparent">
        <div class="navbar-brand">
            <div class="navbar-burger burger" data-target="main-menu" v-on:click.prevent="show_menu($event)">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a v-on:click.prevent="go_to('carousel', $event)" class="navbar-logo" href="/">
                <% if $SiteConfig.SiteLogo %>$SiteConfig.SiteLogo.SetHeight(60)<% else %>$SiteConfig.Title<% end_if %>
            </a>
        </div>
        <div id="main-menu" class="navbar-menu">
            <a v-on:click.prevent="go_to('carousel', $event)" :class="logo_class()" href="/">
                <% if $SiteConfig.SiteLogo %>$SiteConfig.SiteLogo.SetHeight(60)<% else %>$SiteConfig.Title<% end_if %>
            </a>
            <a v-on:click.prevent="go_to(navitem.scrollto, $event)" v-for="(navitem, index) in navitems" :class="make_class(index)" :href="navitem.url">{{navitem.title}}</a>
        </div>
        <div id="language-selector" class="navbar-item has-dropdown" v-if="languages">
            <a v-if="active_lang" class="navbar-link" id="selector-trigger">
                <span class="lang-icon">
                    <img :src="active_lang.icon" />
                </span>
            </a>
            <div class="navbar-dropdown is-boxed is-right">
                <a v-for="language in languages" :class="{'navbar-item': true, 'btn-lang': true, 'is-active': language.is_active}" :data-locale="language.locale">
                    <span class="lang-icon">
                        <img :src="language.icon" />
                    </span>
                    <span class="lang-label">{{language.title}}</span>
                </a>
            </div>
        </div>
    </nav>
</header>
