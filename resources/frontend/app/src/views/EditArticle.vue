<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <mcv-loading v-if="isLoading" />
        <mcv-article-form
          v-if="initialValues"
          :initial-values="initialValues"
          :errors="validationErrors"
          :is-submitting="isSubmitting"
          @articleSubmit="onSubmit"
        />
      </div>
    </div>
  </div>
</template>

<script>
import McvArticleForm from '@/components/ArticleForm'
import McvLoading from '@/components/Loading'
import {mapState} from 'vuex'
import {actionTypes} from '@/store/modules/editArticle'

export default {
  name: 'McvEditArticle',
  components: {McvArticleForm, McvLoading},
  methods: {
    onSubmit(articleInput) {
      const slug = this.$route.params.slug
      this.$store.dispatch(actionTypes.updateArticle, {slug, articleInput}).then((article) => {
        this.$router.push({name: 'article', params: {slug: article.data.slug}})
      })
    },
  },
  computed: {
    ...mapState({
      isSubmitting: (state) => state.editArticle.isSubmitting,
      isLoading: (state) => state.editArticle.isLoading,
      article: (state) => state.editArticle.article,
      validationErrors: (state) => state.editArticle.validationErrors,
    }),
    initialValues() {
      if (!this.article) {
        return null
      }

      const data = {
        name: this.article.data.name,
        description: this.article.data.description,
        tagList: this.article.data.tags,
      }
      if (!data.tagList) {
        data.tagList = []
      } else {
        let tags_arr = []
        for (let i = 0; i < data.tagList.length; i++) {
          tags_arr.push(data.tagList[i].name)
        }
        data.tagList = tags_arr.join(',')
      }

      return data
    },
  },
  mounted() {
    this.$store.dispatch(actionTypes.getArticle, {
      slug: this.$route.params.slug,
    })
  },
}
</script>
