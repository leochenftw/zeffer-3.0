<div class="buy-options columns is-multiline">
    <div v-for="option in options" class="column is-half has-text-centered">
        <a v-if="option.new_tab" :href="option.url" target="_blank" class="buy-option__link">
            <img :src="option.image" height="96" :alt="option.title" /><br />
            <span>{{option.title}}</span>
        </a>
        <a v-else :href="option.url" class="buy-option__link">
            <img :src="option.image" height="96" :alt="option.title" /><br />
            <span>{{option.title}}</span>
        </a>
    </div>
</div>
<div class="content" v-html="sec_cont"></div>
