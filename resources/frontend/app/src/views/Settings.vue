<template>
  <div class="container" v-if="currentUser">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Settings</h1>
        <mcv-validation-errors v-if="validationErrors" :validation-errors="validationErrors" />
        <!-- validationErrors-->
        <form @submit.prevent="onSubmit">
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputName"
              aria-describedby="emailHelp"
              v-model="form.name"
            />
            <div class="form-text">Изменить можно только имя.</div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputEmail"
              aria-describedby="emailHelp"
              v-model="form.email"
            />
          </div>

          <div class="mb-3">
            <label for="exampleInputImg" class="form-label">Img</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputImg"
              aria-describedby="emailHelp"
              v-model="form.img"
            />
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputPassword"
              aria-describedby="emailHelp"
              v-model="form.password"
            />
          </div>

          <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
            Update settings
          </button>
        </form>
        <hr />
        <button type="submit" class="btn btn-danger" @click="logout">
          Or click here to logout
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
import {getterTypes as authGetterTypes, actionTypes as authActionTypes} from '@/store/modules/auth'
import McvValidationErrors from '@/components/ValidationErrors'

export default {
  name: 'McvSettings',
  components: {McvValidationErrors},
  computed: {
    ...mapState({
      isSubmitting: (state) => state.settings.isSubmitting,
      validationErrors: (state) => state.settings.validationErrors,
    }),
    ...mapGetters({
      currentUser: authGetterTypes.currentUser,
    }),
    form() {
      return {
        name: this.currentUser.name,
        img: this.currentUser.img,
        email: this.currentUser.email,
        password: '',
      }
    },
  },
  methods: {
    onSubmit() {
      // console.log(this.form)
      this.$store.dispatch(authActionTypes.updateCurrentUser, this.form)
    },
    logout() {
      this.$store.dispatch(authActionTypes.logout).then(() => {
        this.$router.push({name: 'global_feed'})
      })
    },
  },
}
</script>

<style scoped></style>
