<div id="carousel" class="owl-carousel">
    <div v-for="item in carousel" :class="{'caro-slide': true, 'text-heavy': !item.title_as_link, 'has-text-centered': item.title_as_link}">
        <div v-if="!item.title_as_link" class="container caro-slide__content content" v-html="item.content"></div>
        <h2 class="container caro-slide__content title is-1" v-else>
            <a class="btn-go-to" href="#" :data-scrollto="item.scroll_to">{{item.title}}</a>
        </h2>
        <img class="owl-lazy" :data-src="item.background" :alt="item.title">
    </div>
</div>
