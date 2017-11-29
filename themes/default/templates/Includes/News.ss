<div class="news">
    <div class="news__items">
        <div v-for="article in articles" class="news__item">
            <div v-if="article.type == 'news'" class="news__item__news columns">
                <div class="column is-narrow">
                    <time class="news__item__news__date" :datetime="article.published">
                        <span class="news__item__news__date__month">{{parse_date(article.published).month}}</span>
                        <span class="news__item__news__date__day">{{parse_date(article.published).day}}</span>
                    </time>
                </div>
                <div class="column">
                    <h3 class="title is-5">{{article.title}}</h3>
                    <p class="subtitle is-6"><time class="news__item__news__date" :datetime="article.published">{{friendly(article.published)}}</time></p>
                    <div class="content" v-html="article.content"></div>
                </div>
            </div>
            <div v-else class="news__item__blog">
                <h3 class="title is-5">{{article.title}}</h3>
                <div class="content" v-html="article.content"></div>
            </div>
        </div>
    </div>
</div>
