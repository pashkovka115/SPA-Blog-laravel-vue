<template>
<div>
    <h3 class="mb-3">Populars tags</h3>
    <mcv-loading v-if="isLoading"/>
    <mcv-error-message v-if="error" :message="error"/>
    <div v-if="popularTags" class="sidebar">
        <span class="badge mb-1 mx-1"
              :class="'bg-' + colors[$filters.getRandomInt(colors.length - 1)]"
              v-for="tag in popularTags.data"
              :key="tag.id"
        >
            <router-link
                :to="{name: 'tag', params:{slug: tag.slug}}"
            >{{ tag.name }}</router-link>
        </span>
    </div>
</div>
</template>

<script>
import {mapState} from "vuex";
import {actionTypes} from "@/store/modules/popularTags";
import feedActionTypes from '@/store/modules/feed';
import McvLoading from "@/components/Loading";
import McvErrorMessage from "./ErrorMessage";

export default {
    name: "McvPopularTags",
    components: {McvErrorMessage, McvLoading},
    data(){
        return {
            colors:[
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
                // 'light',
                'dark',
            ]
        }
    },
    computed:{
        ...mapState({
            isLoading: state => state.popularTags.isLoading,
            error: state => state.popularTags.error,
            popularTags: state => state.popularTags.data
        }),
        tagName(){
            return this.$route.params.slug
        },
    },
    mounted() {
        this.$store.dispatch(actionTypes.getPopularTags)
    },
   /* methods:{
        getFeed(){
            const tagName = this.$route.name
            this.$store.dispatch(actionTypes.getFeed, {apiUrl: `/tag/${tagName}`})

            // this.$router.push({name: path.name, params: path.params})

            // console.log(...{path})
        }
    },*/
}
</script>





<style scoped>
a{
    text-decoration: none;
    color: white;
}
</style>
