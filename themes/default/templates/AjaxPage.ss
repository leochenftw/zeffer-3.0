<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <% base_tag %>
        $MetaTags(true)
        <% include OG %>
        <meta name="viewport" content="width=device-width">

        $getCSS

        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

        <% include GA %>
    </head>
    <body class="page-$URLSegment<% if $isMobile %> mobile<% end_if %> page-type-$BodyClass.LowerCase">
        <header id="header">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">$SiteConfig.Title</div>
                    <div class="column">
                        <div id="secondary-menu" class="secondary-nav-wrapper is-relative" v-if="navigation">
                            <p class="title is-4">{{title}}</p>
                            <nav class="secondary-nav">
                                <ul>
                                    <li class="is-inline-block secondary-nav-item" v-for="(navitem, idx) in navigation"><a v-bind:class="{ 'ajax-link': true, 'is-active': navitem.is_active }" v-bind:href="navitem.url">{{navitem.title}}</a></li>
                                </ul>
                            </nav>
                            <div class=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main id="main">
            <div class="container">
                <div class="columns">
                    <nav id="main-nav" class="column is-3">
                        <ul>
                            <li v-for="navitem in navigation">
                                <a v-bind:class="{ 'ajax-link': true, 'is-active': navitem.is_active }" v-bind:href="navitem.url">{{navitem.title}}</a>
                            </li>
                        </ul>
                    </nav>
                    <article class="column content">
                        <h1 id="page-title" class="title is-1" v-html="title"></h1>
                        <div class="columns">
                            <div class="column">
                                <div id="main-content" class="content_text" v-html="content"></div>
                                <div id="audio-terms" class="content_attachments" v-if="audios">
                                    <a v-on:click="play" class="columns" v-for="audio in audios" v-bind:href="audio.url">
                                        <div v-if="audio.initial" class="column is-2">{{audio.initial}}</div>
                                        <div class="column is-4">{{audio.title}}</div>
                                        <div class="column">{{audio.content}}</div>
                                    </a>
                                </div>
                                <div id="questionnaire" class="content__questions" v-if="questions">
                                    <div class="content__questionnaire__question content" v-for="question in questions">
                                        <h2 class="title is-5">{{question.question}}</h2>
                                        <div class="columns">
                                            <ul class="is-marginless column content__questionnaire__question__answers">
                                                <li v-for="answer in question.answers" class="content__questionnaire__question__answer">
                                                    <input class="hide" v-bind:id="for_id(answer.id)" type="checkbox" />
                                                    <label class="label" v-bind:for="for_id(answer.id)">
                                                        {{answer.title}}
                                                        <span v-if="answer.is_correct" class="icon is-correct"><i class="fa fa-check"></i></span>
                                                        <span v-else class="icon is-wrong"><i class="fa fa-times"></i></span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="column is-narrow">
                                                <button class="button is-info is-small" v-on:click="check">Show me</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sequential-quiz" class="sequential-quiz" v-if="sequential_quiz">
                                    <div class="sequential-quiz content" v-for="quiz in sequential_quiz">
                                        <h2 class="title is-5">{{quiz.question}}</h2>
                                        <div class="columns">
                                            <draggable :list="quiz.options" class="is-marginless column sequential-quiz__options">
                                                <li v-bind:data-order="quiz.order" v-for="quiz in quiz.options" class="sequential-quiz__option">{{quiz.title}}</li>
                                            </draggable>
                                            <div class="column is-narrow">
                                                <button class="button is-warning is-small hide" v-on:click="show_me">Show me</button>
                                                <button class="button is-info is-small" v-on:click="check">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="folded-info" class="folded-cards" v-if="cards">
                                    <div class="folded-card" v-for="card in cards">
                                        <button class="button is-info folded-card__trigger icon" v-on:click="click">{{card.title}} <i class="fa fa-plus"></i></button>
                                        <div class="folded-card__folder">
                                            <div class="folded-card__folder__folded">
                                                <p>{{card.first}}</p>
                                                <div class="folded-card has-text-right">
                                                    <button class="button is-warning folded-card__trigger hide-after-click" v-on:click="click">Phonetic Version</button>
                                                    <div class="folded-card__folder has-text-left">
                                                        <div class="folded-card__folder__folded">
                                                            <div class="folded-card__folder__folded__content">
                                                                <p>{{card.second}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="attachments" class="attachments" v-if="files">
                                    <a target="_blank" :href="file.url" class="columns" v-for="file in files">
                                        <div class="column is-narrow"><img width="32" height="32" :alt="file.title" :src="file.extension" /></div>
                                        <div class="column">{{file.title}}</div>
                                        <div class="column is-narrow has-text-right">size: {{file.size}}</div>
                                    </a>
                                </div>
                            </div>
                            <div id="main-video" class="column is-5" v-if="video">
                                <video width="320" height="240" controls>
                                    <source v-bind:src="video.url" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </article>
                    <aside id="main-sidebar" class="column is-3" v-if="image||audio && !main_video.video">
                        <a class="image is-relative" target="_blank" v-if="linked" v-bind:href="pdf.url">
                            <img v-if="image" v-bind:src="image.url" v-bind:alt="image.title" v-bind:width="image.width" v-bind:height="image.height" />
                            <span class="image__text">{{pdf.title}}</span>
                        </a>
                        <div class="image" v-else-if="image">
                            <img v-if="image" v-bind:src="image.url" v-bind:alt="image.title" v-bind:width="image.width" v-bind:height="image.height" />
                        </div>
                        <a class="button audio icon" v-on:click="play" v-if="audio" v-bind:href="audio.url"><i class="fa fa-microphone"></i> {{audio.title}}</a>
                    </aside>
                </div>
            </div>
        </main>
        <footer id="footer"></footer>
    </body>
</html>
