<div class="team-members columns">
    <div v-for="member in members" class="team-member column is-3">
        <div class="team-member__photo">
            <img :src="member.photo" :alt="member.title" />
            <h3 class="team-member__photo__name title is-3 is-bold">{{member.title}}</h3>
        </div>

        <div class="team-member__bio content" v-html="member.content"></div>
    </div>
</div>
