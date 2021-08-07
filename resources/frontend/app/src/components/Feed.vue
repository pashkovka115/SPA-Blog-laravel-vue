<template>
  <div>
    <mcv-loading v-if="isLoading" />
    <mcv-error-message v-if="error" :message="error" />

    <div class="row mb-2" v-if="feed">
      <div class="col-md-6" v-for="(article, index) in feed.data" :key="article.id">
        <div
          class="
            row
            g-0
            border
            rounded
            overflow-hidden
            flex-md-row
            mb-4
            shadow-sm
            h-md-250
            position-relative
          "
        >
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">World</strong>
            <h3 class="mb-0">( {{ article.id }} ) {{ article.name }}</h3>
            <div class="mb-1 text-muted">{{ $filters.date(article.created_at) }}</div>
            <p
              v-if="article.description"
              class="card-text mb-auto"
              v-html="article.description.substr(0, 70) + '...'"
            ></p>
            <mcv-tag-list :tags="article.tags" v-if="article.tags" />

            <router-link
              :to="{name: 'article', params: {slug: article.slug}}"
              style="text-decoration: none"
            >
              Continue reading
            </router-link>
            <br />
            <router-link
              v-if="article.user"
              :to="{name: 'user_profile', params: {slug: article.user.slug}}"
              style="text-decoration: none"
            >
              {{ article.user.name }} &nbsp;
              <img
                :src="article.user.img"
                alt=""
                style="max-height: 50px; width: auto; border-radius: 50%"
              />
            </router-link>
            <mcv-likes :likes="article.likes" :item-id="article.id" :liked="article.liked" />
          </div>

          <div class="col-auto d-none d-lg-block">
            <img :src="article.img" alt="" style="max-width: 200px; height: auto" />
          </div>
        </div>
      </div>

      <mcv-pagination v-if="feed" :links="feed.links" :meta="feed.meta" :api-url="apiUrl" />
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'
import {actionTypes as feedActionTypes} from '@/store/modules/feed'
import McvPagination from '@/components/Pagination'
import {paramForNav} from '@/helpers/vars'
import McvLoading from '@/components/Loading'
import McvErrorMessage from '@/components/ErrorMessage'
import McvTagList from './TagList'
import McvLikes from './Likes'

export default {
  name: 'McvFeed',
  components: {
    McvLikes,
    McvTagList,
    McvErrorMessage,
    McvPagination,
    McvLoading,
  },
  props: {
    apiUrl: {
      type: String,
      required: true,
    },
  },
  computed: {
    ...mapState({
      isLoading: (state) => state.feed.isLoading,
      error: (state) => state.feed.error,
      feed: (state) => state.feed.data,
    }),
    currentPage() {
      return Number(this.$route.query.page || '1')
    },
  },
  mounted() {
    this.$store.dispatch(feedActionTypes.getFeed, {
      apiUrl: this.apiUrl + '?' + paramForNav + '=' + this.currentPage,
    })
  },
}
</script>

<style scoped></style>
