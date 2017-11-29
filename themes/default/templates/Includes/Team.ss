<div class="team-members columns">
    <div v-for="member in members" class="team-member column is-3">
        <div class="team-member__photo"><img :src="member.photo" :alt="member.title" /></div>
        <div class="team-member__bio content" v-html="member.content"></div>
    </div>
</div>
