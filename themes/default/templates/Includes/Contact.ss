<div class="contact columns">
    <div class="column is-7 contact__map">
        <div id="map-holder">
            <div id="map" :data-api="key" :data-lat="lat" :data-lng="lng" data-zoom="12"></div>
        </div>
    </div>
    <div class="column is-5 contact__info">
        <ul class="contact__info__methods">
            <li class="contact__info__method" v-for="method in methods">
                <h3 class="title is-6">{{method.title}}</h3>
                <div class="content" v-html="method.content"></div>
            </li>
        </ul>
        <h3 class="title is-6">Chat with Zeffer online</h3>
        <ul class="contact__info__socials">
            <li class="contact__info__social" v-for="social in socials">
                <a v-if="!social.lightbox" target="_blank" class="contact__info__social__link" :href="social.url"><span :class="make_class(social)"><i :class="social.class"></i></span> {{social.title}}</a>
                <a v-else target="_blank" class="contact__info__social__link" data-lightbox="QR" :href="social.url"><span :class="make_class(social)"><i :class="social.class"></i></span> {{social.title}}</a>
            </li>
        </ul>
    </div>
</div>
