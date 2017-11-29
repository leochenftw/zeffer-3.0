<div class="awards">
    <div v-for="award in awards" class="columns award">
        <div class="column is-1">{{award.year}}</div>
        <div class="column">{{award.class}}</div>
        <div class="column">{{award.competition}}</div>
        <div class="column is-3">{{award.cider}}</div>
    </div>
</div>
