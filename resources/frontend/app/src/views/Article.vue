<template>
    <div class="article-page" v-if="article">
        <div class="banner">
            <div class="container">
                <h1>Banner</h1>
                <p v-if="isAuthor">
                    <router-link :to="{name: 'edit_article', params: {slug: article.data.data.slug}}" class="btn btn-success" style="margin-right: 10px">Редактировать</router-link>
                    <button type="button" class="btn btn-danger" @click="deleteArticle">Удалить</button>
                </p>
            </div>
        </div>
    </div>
    <div class="container" v-if="article">
        <div class="row g-5">
            <article class="blog-post">
                <h2 class="blog-post-title">(ID: {{ article.data.data.id }}) {{ article.data.data.name }}</h2>
<!--                {{ article.data.data.tags }}-->
                <mcv-tag-list :tags="article.data.data.tags"/>
                <p class="blog-post-meta">
                    {{ $filters.date(article.data.data.created_at) }}
                    <router-link :to="{name: 'user_profile', params:{slug: article.data.data.user.slug}}">
                        {{ article.data.data.user.name }}
                    </router-link>
                </p>
                <hr>
                <div v-html="article.data.data.description"></div>
            </article>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <mcv-loading v-if="isLoading"/>
                <mcv-error-message v-if="error" :message="error"/>
            </div>
        </div>
    </div>
</template>

<script>
import {actionTypes as articleActionTypes} from "@/store/modules/article";
import {getterTypes as authGetterTypes} from "@/store/modules/auth";
import {mapState, mapGetters} from 'vuex';
import McvErrorMessage from "@/components/ErrorMessage";
import McvLoading from "@/components/Loading";
import McvTagList from "../components/TagList";

export default {
    name: "McvArticle",
    components: {
        McvTagList,
        McvErrorMessage,
        McvLoading
    },
    mounted() {
        this.$store.dispatch(articleActionTypes.getArticle, {slug: this.$route.params.slug})
    },
    methods:{
        deleteArticle(){
            this.$store.dispatch(articleActionTypes.deleteArticle, {slug: this.$route.params.slug})
            .then((response) => {
                this.$router.push({name: 'global_feed'})
                // console.log(this.$route.params.slug, response)
            })
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.article.isLoading,
            error: state => state.article.error,
            article: state => state.article.data
        }),
        ...mapGetters({
            currentUser: authGetterTypes.currentUser
        }),
        isAuthor(){
            if (!this.article.data.data.user_id || !this.currentUser){
                return false
            }
            return this.article.data.data.user_id === this.currentUser.id
        },
    }
}
</script>

<style scoped>
.banner {
    background-color: #55595C;
    padding-top: 50px;
    padding-bottom: 50px;
    margin-bottom: 40px;
    color: white;
}
</style>
