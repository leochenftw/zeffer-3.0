<div class="awards">
    <div class="columns award__heading">
        <div class="column is-1">Year</div>
        <div class="column">Award & Class</div>
        <div class="column">Competition</div>
        <div class="column is-3">Cider</div>
    </div>
    <div v-for="award in awards" class="columns award">
        <div class="column is-1">{{award.year}}</div>
        <div class="column">{{award.class}}</div>
        <div class="column">{{award.competition}}</div>
        <div class="column is-3">{{award.cider}}</div>
    </div>
</div>
