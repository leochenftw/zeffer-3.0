<div class="awards">
    <div class="columns award__heading">
        <div v-for="(label, i) in labels" :class="{'column': true, 'is-1': i == 0, 'is-3': i == 3}">{{label}}</div>
    </div>
    <div v-for="award in awards" class="columns award">
        <div class="column is-1">{{award.year}}</div>
        <div class="column">{{award.class}}</div>
        <div class="column">{{award.competition}}</div>
        <div class="column is-3">{{award.cider}}</div>
    </div>
</div>
