<template>
<div class="feed-toggle">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item" v-if="isLoggedIn">
            <router-link :to="{name: 'your_feed'}" class="nav-link" active-class="active">Your feed</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'global_feed'}" class="nav-link" active-class="active">Global feed</router-link>
        </li>
        <li class="nav-item" v-if="routerName === 'tag'">
            <router-link :to="{name: 'tag', params:{slug: tagName}}" class="nav-link" active-class="active">#{{ tagName }}</router-link>
        </li>
    </ul>
</div>
</template>

<script>
import {mapGetters} from 'vuex';
import {getterTypes} from "@/store/modules/auth";

export default {
    name: "McvFeedToggler",
    props:{
        tagName:{
            type: String,
            required: false
        }
    },
    computed:{
        ...mapGetters({
            isLoggedIn: getterTypes.isLoggedIn
        }),
        routerName(){
            return this.$route.name
        }
    }
}
</script>

<style scoped>

</style>
