<div class="news">
    <div class="news__items">
        <div v-for="article in articles" class="news__item">
            <div class="news__item__news columns is-variable is-6">
                <div class="column is-narrow">
                    <div class="news__item__news__date-cube" :datetime="article.published">
                        {{article.type}}
                    </div>
                </div>
                <div class="column">
                    <p class="news__item__news__category subtitle is-6" v-if="article.category"><a :href="make_link('category', article.category.slug)">{{article.category.title}}</a></p>
                    <h3 class="news__item__news__title title is-2">{{article.title}}</h3>
                    <p class="subtitle is-5"><time class="news__item__news__date" :datetime="article.published">{{friendly(article.published)}}</time></p>
                    <div class="news__item__news__content content" v-html="article.content"></div>
                    <div v-if="article.tags" class="news__item__blog__tags">
                        Tagged: <a class="news__item__blog__tag" :href="make_link('tag', tag.slug)" v-for="tag in article.tags">{{tag.title}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="next_page" class="news__items__load-more has-text-centered">
            <button class="button is-info is-large" :data-next="next_page">Load more</button>
        </div>
    </div>
</div>
