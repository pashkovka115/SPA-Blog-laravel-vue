<template>
    <div class="auth-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Sign Up</h1>
                    <p>
                        <router-link :to="{name: 'login'}">Have an account?</router-link>
                    </p>

                    <mcv-validation-errors v-if="validationErrors" :validation-errors="validationErrors" />

                    <form @submit.prevent="onSubmit">
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Имя" v-model="name">
                        </fieldset>
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" v-model="email">
                        </fieldset>
                        <fieldset class="form-group mb-3">
                            <input type="password" class="form-control" placeholder="Пароль" v-model="password">
                        </fieldset>
                        <fieldset class="form-group mb-3">
                            <input type="password" class="form-control" placeholder="Подтвердите пароль" v-model="password_confirmation">
                        </fieldset>

                        <button class="btn btn-primary" :disabled="isSubmitting">Sign Up</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import McvValidationErrors from "@/components/ValidationErrors";
import {actionTypes} from "@/store/modules/auth";
import {mapState} from "vuex";


export default {
    name: "McvRegister",
    components: {McvValidationErrors},
    data(){
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    computed: {
        ...mapState({
            isSubmitting: state => state.auth.isSubmitting,
            validationErrors: state => state.auth.validationErrors
        })
        /*isSubmitting() {
            return this.$store.state.auth.isSubmitting
        },
        validationErrors() {
            return this.$store.state.auth.validationErrors
        },*/
    },
    methods: {
        onSubmit() {
            // this.$store.commit('registerStart')
            this.$store.dispatch(actionTypes.register, {
                email: this.email,
                name: this.name,
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then(user => {
                // console.log('successfully register user', user)
                this.$router.push({name: 'global_feed'})
            })
        }
    }
}
</script>

<style scoped>
/* просмотрел: модуль 2 - видео 5. Добавляем API запрос на регистрацию.mp4 */
</style>
