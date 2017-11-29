<div class="buy-options columns is-multiline">
    <div v-for="option in options" class="column is-half has-text-centered">
        <a v-if="option.new_tab" :href="option.url" target="_blank" class="button is-info is-large">{{option.title}}</a>
        <a v-else :href="option.url" class="button is-info is-large">{{option.title}}</a>
    </div>
</div>
<div class="content" v-html="sec_cont"></div>
