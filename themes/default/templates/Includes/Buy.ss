<div class="buy-options columns is-variable is-8">
    <div class="column is-half buy-options__region has-text-centered">
        <h3 class="title is-2">Buy online - NZ</h3>
        <div class="columns is-mobile is-multiline">
            <div v-for="option in options.NZ" class="column is-half has-text-centered">
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
    </div>
    <div class="column is-half buy-options__region has-text-centered">
        <h3 class="title is-2">Buy online - AUS</h3>
        <div class="columns is-mobile is-multiline">
            <div v-for="option in options.AUS" class="column is-half has-text-centered">
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
    </div>

</div>
<div class="content" v-html="sec_cont"></div>
