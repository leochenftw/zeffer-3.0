<section id="ciders">
    <div class="section">
        <div class="container">
            <div class="ciders__heading">
                <h2 class="title is-2">{{title}}</h2>
                <div class="content" v-html="content"></div>
            </div>
            <nav class="ciders__menu">
                <a v-on:click.prevent="go_to(cider.title)" class="ciders__menu__item" v-for="cider in ciders"><span>{{cider.title}}</span></a>
            </nav>
            <div v-if="ciders" class="ciders">
                <div v-for="cider in ciders" :class="make_class(cider.colour)" :data-cider="cider.title">
                    <div class="column is-4 cider__image">
                        <img v-if="cider" :src="cider.product_image" />
                        <p v-else>&lt;This cider has no image&gt;</p>
                    </div>
                    <div v-if="!cider.is_reserved" class="column is-8 cider__details">
                        <h3 v-if="cider.title_image" class="cider__details__heading title is-2">
                            <img :src="cider.title_image" :alt="cider.title" />
                        </h3>
                        <h3 v-else class="title is-3">{{cider.title}}</h3>
                        <p v-if="cider.subtitle" class="title is-3">{{cider.subtitle}}</p>
                        <div class="content cider__details__content" v-html="cider.content"></div>
                        <div class="columns is-multiline cider__details__taste-sheet">
                            <div class="column is-half">
                                <div class="columns is-marginless is-mobile">
                                    <div class="column is-3">
                                        <div class="cider__details__taste-sheet__icon">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuMDAxIDUxMi4wMDEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMi4wMDEgNTEyLjAwMTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik01MDMuNjk4LDIzMS44OTVjLTI4LjczNS0zNi44NDMtNjUuOTU2LTY3LjMxOC0xMDcuNjM3LTg4LjEyOGMtNDIuNTQ4LTIxLjI0My04OC4zMjEtMzIuMjY1LTEzNi4xMDQtMzIuODQzICAgIGMtMS4zMTYtMC4wMzYtNi42LTAuMDM2LTcuOTE2LDBjLTQ3Ljc4MiwwLjU3OS05My41NTYsMTEuNi0xMzYuMTA0LDMyLjg0M2MtNDEuNjgxLDIwLjgxLTc4LjksNTEuMjg0LTEwNy42MzYsODguMTI4ICAgIGMtMTEuMDcsMTQuMTkzLTExLjA3LDM0LjAxOCwwLDQ4LjIxMWMyOC43MzUsMzYuODQzLDY1Ljk1NSw2Ny4zMTgsMTA3LjYzNiw4OC4xMjhjNDIuNTQ4LDIxLjI0Myw4OC4zMjEsMzIuMjY1LDEzNi4xMDQsMzIuODQzICAgIGMxLjMxNiwwLjAzNiw2LjYsMC4wMzYsNy45MTYsMGM0Ny43ODItMC41NzksOTMuNTU2LTExLjYsMTM2LjEwNC0zMi44NDNjNDEuNjgxLTIwLjgxLDc4LjkwMS01MS4yODQsMTA3LjYzNy04OC4xMjggICAgQzUxNC43NjgsMjY1LjkxMSw1MTQuNzY4LDI0Ni4wODgsNTAzLjY5OCwyMzEuODk1eiBNMTI1LjI0MiwzNDkuNTk5Yy0zOC45Mi0xOS40MzItNzMuNjc4LTQ3Ljg5Mi0xMDAuNTE3LTgyLjMwMyAgICBjLTUuMTg3LTYuNjUxLTUuMTg3LTE1Ljk0LDAtMjIuNTkxYzI2LjgzOC0zNC40MTEsNjEuNTk2LTYyLjg3MSwxMDAuNTE3LTgyLjMwM2MxMS4wNTQtNS41MTgsMjIuMzQyLTEwLjI5LDMzLjgzOS0xNC4zMyAgICBjLTI5LjU3OCwyNi41ODgtNDguMjEzLDY1LjEyLTQ4LjIxMywxMDcuOTI4YzAsNDIuODEsMTguNjM2LDgxLjM0NSw0OC4yMTcsMTA3LjkzMiAgICBDMTQ3LjU4OCwzNTkuODkyLDEzNi4yOTcsMzU1LjExOCwxMjUuMjQyLDM0OS41OTl6IE0yNTYsMzgwLjMwM2MtNjguNTQyLDAtMTI0LjMwNC01NS43NjItMTI0LjMwNC0xMjQuMzA0ICAgIFMxODcuNDU4LDEzMS42OTYsMjU2LDEzMS42OTZTMzgwLjMwNCwxODcuNDU4LDM4MC4zMDQsMjU2UzMyNC41NDIsMzgwLjMwMywyNTYsMzgwLjMwM3ogTTQ4Ny4yNzUsMjY3LjI5NSAgICBjLTI2LjgzOCwzNC40MTEtNjEuNTk2LDYyLjg3MS0xMDAuNTE3LDgyLjMwM2MtMTEuMDQxLDUuNTEyLTIyLjMyMiwxMC4yNjMtMzMuODA1LDE0LjI5OSAgICBjMjkuNTU4LTI2LjU4Nyw0OC4xNzktNjUuMTA3LDQ4LjE3OS0xMDcuODk4YzAtNDIuODE0LTE4LjY0LTgxLjM1MS00OC4yMjMtMTA3LjkzOWMxMS41LDQuMDQxLDIyLjc5Myw4LjgxOSwzMy44NSwxNC4zNCAgICBjMzguOTIsMTkuNDMyLDczLjY3OCw0Ny44OTIsMTAwLjUxNyw4Mi4zMDNDNDkyLjQ2MiwyNTEuMzU1LDQ5Mi40NjIsMjYwLjY0NCw0ODcuMjc1LDI2Ny4yOTV6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjU2LDIwMi44MDRjLTI5LjMzMiwwLTUzLjE5NSwyMy44NjMtNTMuMTk1LDUzLjE5NXMyMy44NjMsNTMuMTk1LDUzLjE5NSw1My4xOTVzNTMuMTk1LTIzLjg2Myw1My4xOTUtNTMuMTk1ICAgIEMzMDkuMTk2LDIyNi42NjcsMjg1LjMzMywyMDIuODA0LDI1NiwyMDIuODA0eiBNMjU2LDI4OC4zNjdjLTE3Ljg0NywwLTMyLjM2OC0xNC41MTktMzIuMzY4LTMyLjM2OCAgICBjMC0xNy44NDgsMTQuNTE5LTMyLjM2NywzMi4zNjgtMzIuMzY3YzE3Ljg0NywwLDMyLjM2NywxNC41MTksMzIuMzY3LDMyLjM2N0MyODguMzY4LDI3My44NDgsMjczLjg0NywyODguMzY3LDI1NiwyODguMzY3eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
                                        </div>
                                    </div>
                                    <div class="column cider__details__taste-sheet__details">
                                        <h4>{{labels.see}}</h4>
                                        <p>{{cider.see}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="columns is-marginless is-mobile">
                                    <div class="column is-3">
                                        <div class="cider__details__taste-sheet__icon">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTM4Ny45MjIsMjg3LjkzOGMwLDAtNDIuNzgxLTI4Ny45MzgtMTMxLjkzOC0yODcuOTM4UzEyNC4wNzgsMjg3LjkzOCwxMjQuMDc4LDI4Ny45MzggICAgYy0zNi40MDYsMTIuODQ0LTYyLjUsNDcuNTMxLTYyLjUsODguMzQ0YzAsNTEuNjU2LDQxLjgxMiw5My41NDcsOTMuNDM4LDkzLjY3MkMxNzcuNDg0LDQ5NS40MDYsMjE0LjM1OSw1MTIsMjU1Ljk4NCw1MTIgICAgYzQxLjY1NiwwLDc4LjUtMTYuNTk0LDEwMS00Mi4wNDdjNTEuNjI1LTAuMTI1LDkzLjQzOC00Mi4wMTYsOTMuNDM4LTkzLjY3MkM0NTAuNDIyLDMzNS40NjksNDI0LjMyOCwzMDAuNzgxLDM4Ny45MjIsMjg3LjkzOHogICAgIE00MDcuOTUzLDQyNy4zNzVjLTEzLjYyNSwxMy42NDEtMzEuNzUsMjEuMTg4LTUxLjAzMSwyMS4yMzRsLTkuNTk0LDAuMDMxbC02LjM0NCw3LjE4OGMtMTkuMjgxLDIxLjgxMi01MS4wMzEsMzQuODQ0LTg1LDM0Ljg0NCAgICBjLTMzLjkzOCwwLTY1LjcxOS0xMy4wMzEtODQuOTY5LTM0Ljg0NGwtNi4zNzUtNy4xODhsLTkuNTk0LTAuMDMxYy0xOS4yODEtMC4wNDctMzcuNDA2LTcuNTk0LTUxLjAzMS0yMS4yMzQgICAgQzkwLjM5LDQxMy43MTksODIuODksMzk1LjU2Myw4Mi44OSwzNzYuMjgxYzAtMzAuNjI1LDE5LjQwNi01OC4wNDcsNDguMjgxLTY4LjIzNGwxMi4xMjUtNC4yNjZsMS44NzUtMTIuNzAzICAgIGMwLjA5NC0wLjcxOSwxMC43ODEtNzEuNjQxLDMxLjk2OS0xNDEuMzEyYzEyLjEyNS0zOS45NTMsMjUuMjE5LTcxLjUsMzguOTA2LTkzLjc2NmM5LjcxOS0xNS44MTIsMjQuNTMxLTM0LjY1NiwzOS45MzgtMzQuNjU2ICAgIGMxNS40MzgsMCwzMC4yNSwxOC44NDQsMzkuOTY5LDM0LjY1NmMxMy42NTYsMjIuMjY2LDI2Ljc1LDUzLjgxMiwzOC45MDYsOTMuNzY2YzIxLjE1Niw2OS42NzIsMzEuODQ0LDE0MC41OTQsMzEuOTM4LDE0MS4yOTcgICAgbDEuOTA2LDEyLjcxOWwxMi4xMjUsNC4yNjZjMjguODc1LDEwLjE4OCw0OC4yNSwzNy42MDksNDguMjUsNjguMjM0QzQyOS4wNzgsMzk1LjU2Miw0MjEuNTc4LDQxMy43MTksNDA3Ljk1Myw0MjcuMzc1eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTE1NS4yMzQsNDA0LjI4MWMtMTUuNDM4LDAtMjgtMTIuNTYyLTI4LTI4YzAtNS44OTEtNC43ODEtMTAuNjcyLTEwLjY1Ni0xMC42NzJjLTUuOTA2LDAtMTAuNjg4LDQuNzgxLTEwLjY4OCwxMC42NzIgICAgYzAsMjcuMjM0LDIyLjA5NCw0OS4zMjgsNDkuMzQ0LDQ5LjMyOGM1LjkwNiwwLDEwLjY1Ni00Ljc4MSwxMC42NTYtMTAuNjcyUzE2MS4xNDEsNDA0LjI4MSwxNTUuMjM0LDQwNC4yODF6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                        </div>
                                    </div>
                                    <div class="column cider__details__taste-sheet__details">
                                        <h4>{{labels.smell}}</h4>
                                        <p>{{cider.smell}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="columns is-marginless is-mobile">
                                    <div class="column is-3">
                                        <div class="cider__details__taste-sheet__icon">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyNS42MjQgMzI1LjYyNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMzI1LjYyNCAzMjUuNjI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPHBhdGggZD0iTTMyNC41MjEsMTM0LjMzN2MtMS42ODQtMi43NS00LjkzNy00LjExNy04LjA3OS0zLjM5M2MtMi44ODEsMC42NjMtNS41NDEsMC45ODUtOC4xMywwLjk4NSAgIGMtMTAuNzEyLDAtMTkuMDI2LTUuOTM4LTI5LjU1My0xMy40NTRjLTExLjI3OS04LjA1NC0yNS4zMTctMTguMDc3LTQ2LjYyMi0yMy40MjFjLTEwLjI4MS0yLjU3OS0yMC43MDktMy44ODctMzAuOTkyLTMuODg3ICAgYy0xOC42OTUsMC0zMi4zNzYsNC4zMDQtMzguMzMyLDYuNTk0Yy01Ljk1Ny0yLjI5LTE5LjYzOC02LjU5NC0zOC4zMzMtNi41OTRjLTEwLjI4NCwwLTIwLjcxMiwxLjMwOC0zMC45OTMsMy44ODcgICBjLTIxLjMwNCw1LjM0My0zNS4zNDIsMTUuMzY2LTQ2LjYyMiwyMy40MmMtMTAuNTI4LDcuNTE3LTE4Ljg0MywxMy40NTQtMjkuNTU1LDEzLjQ1NWMtMC4wMDIsMC0wLjAwMiwwLTAuMDA0LDAgICBjLTIuNTg2LDAtNS4yNDQtMC4zMjItOC4xMjYtMC45ODVjLTMuMTQ1LTAuNzIzLTYuMzk1LDAuNjQ0LTguMDgsMy4zOTRjLTEuNjgzLDIuNzUxLTEuNDE5LDYuMjcsMC42NTUsOC43MzkgICBjMS4yODMsMS41MjcsMTAuMzM2LDExLjIyNSwzNy40MjYsMTcuMTJjMi4xMiwyMS40NjIsMTUuMjIzLDQwLjMzLDM3LjQ0Myw1My42MjNjMjIuMjQzLDEzLjMwOCw1Mi44NTEsMjAuNjM2LDg2LjE4NywyMC42MzYgICBjMzMuMzM0LDAsNjMuOTQyLTcuMzI4LDg2LjE4Ni0yMC42MzZjMjIuMjItMTMuMjkzLDM1LjMyMi0zMi4xNiwzNy40NDItNTMuNjIyYzI3LjA5Ni01Ljg5NiwzNi4xNDUtMTUuNTk2LDM3LjQyOC0xNy4xMjMgICBDMzI1Ljk0MSwxNDAuNjA2LDMyNi4yMDQsMTM3LjA4NywzMjQuNTIxLDEzNC4zMzd6IE0yNDEuMjk4LDIwMC45NDhjLTE5Ljk0OSwxMS45MzUtNDcuODIyLDE4LjUwOC03OC40ODQsMTguNTA4ICAgYy0zMC42NjMsMC01OC41MzctNi41NzMtNzguNDg2LTE4LjUwOGMtMTIuMDgtNy4yMjctMjYuMTczLTE5LjQzOC0yOS42NDYtMzguMTI3YzkuNDU5LDEuMTk4LDIwLjQ4NSwxLjkzNCwzMy4zMjMsMS45MzQgICBjMjIuMDAyLDAsNDcuMTY1LTIuMTgzLDc0LjgwOS02LjQ4N2MyNy42NDQsNC4zMDUsNTIuODA3LDYuNDg3LDc0LjgwOCw2LjQ4N2MxMi44MzcsMCwyMy44NjMtMC43MzUsMzMuMzIyLTEuOTM0ICAgQzI2Ny40NywxODEuNTExLDI1My4zNzgsMTkzLjcyMSwyNDEuMjk4LDIwMC45NDh6IE0yMzcuNjIxLDE0OS43NTVjLTIxLjUzMiwwLTQ2LjMwOC0yLjE4My03My42NDEtNi40ODcgICBjLTAuMzg3LTAuMDYxLTEuOTQ3LTAuMDYxLTIuMzM0LDBjLTI3LjMzMyw0LjMwNS01Mi4xMSw2LjQ4Ny03My42NDIsNi40ODdjLTI0LjgyMSwwLTQxLjk5OC0yLjg5OS01My41NzUtNi4yNjYgICBjNy41MzEtMy4wOCwxNC4yMjgtNy44NjIsMjEuMTUzLTEyLjgwN2MxMC43ODQtNy43LDIzLjAwNi0xNi40MjcsNDEuNTU1LTIxLjA3OWM5LjA4OS0yLjI4LDE4LjI4OS0zLjQzNSwyNy4zNDMtMy40MzUgICBjMjEuMjUzLDAsMzQuOTQsNi40MTUsMzUuMDUxLDYuNDY4YzIuMDcxLDEuMDA4LDQuNDkyLDEuMDA5LDYuNTY0LTAuMDAxYzAuMTMzLTAuMDY0LDEzLjUzNS02LjQ2NywzNS4wNDktNi40NjcgICBjOS4wNTQsMCwxOC4yNTMsMS4xNTUsMjcuMzQyLDMuNDM1YzE4LjU1LDQuNjUzLDMwLjc3MiwxMy4zOCw0MS41NTUsMjEuMDc5YzYuOTI1LDQuOTQ1LDEzLjYyMyw5LjcyOSwyMS4xNTQsMTIuODA5ICAgQzI3OS42MiwxNDYuODU2LDI2Mi40NDUsMTQ5Ljc1NSwyMzcuNjIxLDE0OS43NTV6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                        </div>
                                    </div>
                                    <div class="column cider__details__taste-sheet__details">
                                        <h4>{{labels.taste}}</h4>
                                        <p>{{cider.taste}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="columns is-marginless is-mobile">
                                    <div class="column is-3">
                                        <div class="cider__details__taste-sheet__icon">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDU0MC4yMDEgNTQwLjIwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTQwLjIwMSA1NDAuMjAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTE2OS40NjcsMTk0LjEwMnYzMTAuMTM2YzAsOC4wODYsMi45NSwxNS4wOCw4Ljg2MiwyMC45ODZjNS44MDgsNS44MDksMTIuNjgxLDguNzMyLDIwLjYsOC44MjQgICAgYzcuOTE0LTAuMDkyLDE0Ljc5Mi0zLjAxNiwyMC42MDYtOC44MjRjNS45MDYtNS45MDYsOC44NTUtMTIuOSw4Ljg1NS0yMC45ODZWMTk0LjEwMmM4Ljg2Mi0zLjEwMyw0Mi4wODEtMzIuNzExLDQyLjA4MS00Mi4yMDQgICAgVjI3LjE2MWMwLTQuMDMzLTEuNDgxLTcuNTM0LTQuNDMxLTEwLjQ5Yy0yLjk1Ni0yLjk1LTYuNDU3LTQuNDMxLTEwLjQ5LTQuNDMxYy00LjA0NSwwLTcuNTQsMS40ODEtMTAuNDksNC40MzEgICAgYy0yLjk1NiwyLjk2Mi00LjQzMSw2LjQ1Ny00LjQzMSwxMC40OXY5Ni45OWMwLDQuMDQ1LTEuNDgxLDcuNTQtNC40MzEsMTAuNDljLTIuOTU2LDIuOTU2LTYuNDUxLDQuNDI1LTEwLjQ5LDQuNDI1ICAgIGMtNC4wNDUsMC03LjU0LTEuNDY5LTEwLjQ5LTQuNDI1Yy0yLjk1LTIuOTUtNC40MzEtNi40NTEtNC40MzEtMTAuNDl2LTk2Ljk5YzAtNC4wMzMtMS40ODEtNy41MzQtNC40MzEtMTAuNDkgICAgYy0yLjk1LTIuOTUtNi40NS00LjQzMS0xMC40ODktNC40MzFjLTQuMDQ1LDAtNy41NCwxLjQ4MS0xMC40OSw0LjQzMWMtMi45NTYsMi45NjItNC40MzEsNi40NTctNC40MzEsMTAuNDl2OTYuOTkgICAgYzAsNC4wNDUtMS40ODEsNy41NC00LjQzMSwxMC40OWMtMi45NTYsMi45NTYtNi40NTEsNC40MjUtMTAuNDksNC40MjVjLTQuMDQ1LDAtNy41NC0xLjQ2OS0xMC40OS00LjQyNSAgICBjLTIuOTU2LTIuOTUtNC40MzEtNi40NTEtNC40MzEtMTAuNDl2LTk2Ljk5YzAtNC4wMzMtMS40NzUtNy41MzQtNC40MzEtMTAuNDljLTIuOTUtMi45NS02LjQ1LTQuNDMxLTEwLjQ5LTQuNDMxICAgIGMtNC4wNDUsMC03LjU0LDEuNDgxLTEwLjQ4OSw0LjQzMWMtMi45NSwyLjk2Mi00LjQzMSw2LjQ1Ny00LjQzMSwxMC40OXYxMjQuNzMyQzEyMS4yNjYsMTYxLjM4NCwxNjAuNjA1LDE5MC45OTMsMTY5LjQ2NywxOTQuMTAyICAgIHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cGF0aCBkPSJNMTk5LjMwOCw1MzQuMDhjLTAuMTI5LDAtMC4yNTEtMC4wMzctMC4zOC0wLjAzN2MtMC4xMjgsMC0wLjI0NSwwLjAzNy0wLjM3OSwwLjAzN0gxOTkuMzA4eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik0zODkuODQ4LDU0MC4yMDFjLTAuMTI5LDAtMC4yNS0wLjAzNy0wLjM3OS0wLjAzN3MtMC4yNTIsMC4wMzctMC4zNzksMC4wMzdIMzg5Ljg0OHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cGF0aCBkPSJNMzI2LjEzOSwyNjguNTg4aDMzLjg2OXYyNDEuNzcxYzAsOC4wODQsMi45NDksMTUuMDgsOC44NTUsMjAuOTg0YzUuODEyLDUuODA5LDEyLjY4Niw4LjczNCwyMC42MDUsOC44MjYgICAgYzcuOTEyLTAuMDkyLDE0Ljc5MS0zLjAxOCwyMC42MDUtOC44MjZjNS45MDYtNS45MDQsOC44NjEtMTIuOSw4Ljg2MS0yMC45ODRWMTQuOTIxYzAtNC4wMzMtMS40OC03LjUzNC00LjQzLTEwLjQ5ICAgIEM0MTEuNTQ5LDEuNDgxLDQwOC4wNTUsMCw0MDQuMDE2LDBoLTEwLjcyM2MtMjAuNTIsMC0zOC4wODQsNy4zMDgtNTIuNjkzLDIxLjkxNmMtMTQuNjA3LDE0LjYxNC0yMS45MTQsMzIuMTc5LTIxLjkxNCw1Mi42OTMgICAgdjE4Ni41MmMwLDIuMDIsMC43NCwzLjc3LDIuMjE1LDUuMjQ1QzMyMi4zNjksMjY3Ljg0OCwzMjQuMTE5LDI2OC41ODgsMzI2LjEzOSwyNjguNTg4eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
                                        </div>
                                    </div>
                                    <div class="column cider__details__taste-sheet__details">
                                        <h4>{{labels.trywith}}</h4>
                                        <p>{{cider.trymewith}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="with-title">
                                    <h4>{{labels.dryness}}</h4>
                                    <div class="columns dryness is-marginless is-mobile">
                                        <div v-for="n in 5" class="column"><div class="cross"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="with-title">
                                    <h4>{{labels.tannin}}</h4>
                                    <div class="columns tannin is-marginless is-mobile">
                                        <div v-for="n in 5" class="column"><div class="cross"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="with-title">
                                    <h4>{{labels.avail}}</h4>
                                    <div class="columns is-marginless availabilities is-mobile">
                                        <div v-for="availability in cider.availabilities" class="has-text-centered column is-4">{{availability}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="column is-8 cider__details is-reserved-range">
                        <h3 class="cider__details__title info-line is-relative">{{cider.title}}</h3>
                        <p class="cider__details__style info-line is-relative">{{cider.productstyle}}</p>
                        <p class="cider__details__vintage info-line is-relative">{{cider.proudctvintage}}</p>
                        <p class="cider__details__signature info-line is-relative">
                            <img :src="cider.product_signature" alt="cider signature" />
                        </p>
                        <div class="content cider__details__content" v-html="cider.content"></div>
                        <div class="columns cider__details__table is-marginless">
                            <div class="is-2 column cider__details__vintage-col">{{cider.proudctvintage}}</div>
                            <div class="is-5 column cider__details__style-col">{{cider.productstyle}}</div>
                            <div class="is-5 column cider__details__try-with-col">{{cider.trymewith}}</div>
                        </div>
                        <div class="columns is-mobile">
                            <div class="is-6 column content cider__details__availability-col">
                                <div class="with-title">
                                    <h4>Available in</h4>
                                    <div class="columns is-mobile is-marginless">
                                        <div v-for="availability in cider.availabilities" class="has-text-centered column is-4">{{availability}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="cider.is_reserved" class="cider__alcohol column is-4 has-text-centered">{{cider.alchohol}}% ALC</div>
                </div>
            </div>
        </div>
    </div>
    <div class="end-of-section"></div>
</section>
