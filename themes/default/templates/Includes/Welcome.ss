<div class="welcome">
    <ul class="welcome__info__socials">
        <li class="welcome__info__social is-inline-block" v-for="social in socials">
            <a v-if="!social.lightbox" target="_blank" class="welcome__info__social__link" :href="social.url" :title="social.title"><img :src="social.icon" width="64" height="64" /></a>
            <a v-else target="_blank" class="welcome__info__social__link" data-lightbox="QR" :href="social.url" :title="social.title"><img :src="social.icon" width="64" height="64" /></a>
        </li>
    </ul>
</div>
