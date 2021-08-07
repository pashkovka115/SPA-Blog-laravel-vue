<template>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-center">
      <router-link
        :to="{name: 'global_feed'}"
        exact
        class="p-2 link-secondary"
        active-class="active"
      >
        Home
      </router-link>

      <template v-if="isLoggedIn">
        <router-link
          :to="{name: 'create_article'}"
          class="p-2 link-secondary"
          active-class="active"
        >
          New Article
        </router-link>
        <router-link :to="{name: 'settings'}" class="p-2 link-secondary" active-class="active">
          Settings
        </router-link>
        <router-link
          :to="{name: 'user_profile', params: {slug: currentUser.name}}"
          class="p-2 link-secondary"
          active-class="active"
        >
          <img
            class="user-pic"
            :src="currentUser.img"
            alt=""
            style="max-height: 26px; width: auto; margin-right: 10px; border-radius: 50%"
          />
          &nbsp;
          {{ currentUser.name }}
        </router-link>
      </template>

      <template v-if="isAnonymous">
        <router-link :to="{name: 'login'}" class="p-2 link-secondary" active-class="active">
          Login
        </router-link>
        <router-link :to="{name: 'register'}" class="p-2 link-secondary" active-class="active">
          Register
        </router-link>
      </template>

      <router-link :to="{name: 'about'}" exact class="p-2 link-secondary" active-class="active">
        About me
      </router-link>
    </nav>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import {getterTypes} from '@/store/modules/auth'

export default {
  name: 'McvTopBar',
  computed: {
    ...mapGetters({
      currentUser: getterTypes.currentUser,
      isLoggedIn: getterTypes.isLoggedIn,
      isAnonymous: getterTypes.isAnonymous,
    }),
    /* ...mapState({
            // currentUser: state => state.auth.currentUser,
             isLoggedIn: state => state.auth.isLoggedIn
        }),
        currentUser(){
            return this.$store.getters[getterTypes.currentUser]
        },
        isLoggedIn(){
            return this.$store.getters[getterTypes.isLoggedIn]
        },
        isAnonymous(){
            return this.$store.getters[getterTypes.isAnonymous]
        },*/
  },
}
</script>

<style>
.active {
  color: #212529;
  font-weight: bold;
}
</style>
