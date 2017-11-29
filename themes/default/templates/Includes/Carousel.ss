<div id="carousel" class="owl-carousel">
    <img v-for="item in carousel" class="owl-lazy" :data-src="item.background" :alt="item.title">
</div>
