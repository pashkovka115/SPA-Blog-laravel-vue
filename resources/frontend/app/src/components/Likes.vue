<template>
  <div style="position: relative">
    <button
      :disabled="isLoading"
      type="button"
      class="btn my-3"
      :class="{'btn-outline-primary': !tmpLiked, 'btn-primary': tmpLiked}"
      @click="likedDisliked"
    >
      <i class="far fa-thumbs-up"></i> <span class="badge bg-primary">{{ tmpLikes }}</span>
    </button>
    <p class="text-danger error" v-if="show_error">Вы не авторизованы!</p>
  </div>
</template>

<script>
import {actionTypes as likesActionTypes} from '@/store/modules/likes'
import {getterTypes as authGetterTypes} from '@/store/modules/auth'
import {mapState, mapGetters} from 'vuex'

export default {
  name: 'McvLikes',
  props: {
    likes: {
      type: Number,
      required: true,
    },
    liked: {
      type: Boolean,
      required: true,
    },
    itemId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      tmpLikes: 0,
      tmpLiked: null,
      show_error: false,
    }
  },
  methods: {
    likedDisliked() {
      if (this.isAnonymous) {
        this.show_error = true
        setTimeout(() => (this.show_error = false), 3000)
        return
      }
      this.$store.dispatch(likesActionTypes.addLike, this.itemId).then((response) => {
        if (this.tmpLiked) {
          this.tmpLiked = false
          this.tmpLikes -= 1
        } else {
          this.tmpLiked = true
          this.tmpLikes += 1
        }
      })
    },
  },
  mounted() {
    this.tmpLikes = this.likes
    this.tmpLiked = this.liked
  },
  computed: {
    ...mapState({
      isLoading: (state) => state.likes.isLoading,
    }),
    ...mapGetters({
      // currentUser: getterTypes.currentUser,
      // isLoggedIn: authGetterTypes.isLoggedIn,
      isAnonymous: authGetterTypes.isAnonymous,
    }),
  },
}
</script>

<style scoped>
p.error {
  position: absolute;
  left: 0;
  top: -10px;
}
</style>
