<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="$ContentLocale" class="no-js"> <!--<![endif]-->
    <head>
        <% base_tag %>
        $MetaTags(true)
        <% include OG %>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <meta name="viewport" content="width=device-width">
        $getCSS
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <% include GA %>
    </head>
    <body class="page-$URLSegment<% if $isMobile %> mobile<% end_if %> page-type-$BodyClass.LowerCase $ContentLocale.LowerCase is-static">
        <% include Header %>
        <main id="main">
            $Layout
        </main>
        <footer id="footer" class="section">
            <div class="container">
                <div class="has-text-centered copyright">&copy; $Now.Year $SiteConfig.Title</div>
            </div>
        </footer>
        <script src="/themes/default/node_modules/lightbox2/dist/js/lightbox.min.js"></script>
    </body>
</html>
