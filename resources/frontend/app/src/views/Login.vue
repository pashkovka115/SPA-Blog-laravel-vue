<template>
    <div class="auth-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Sign In</h1>
                    <p>
                        <router-link :to="{name: 'register'}">Need an account?</router-link>
                    </p>

                    <mcv-validation-errors v-if="validationErrors" :validation-errors="validationErrors" />

                    <form @submit.prevent="onSubmit">
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" v-model="email">
                        </fieldset>
                        <fieldset class="form-group mb-3">
                            <input type="password" class="form-control" placeholder="Пароль" v-model="password">
                        </fieldset>

                        <button class="btn btn-primary" :disabled="isSubmitting">Sign In</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'

import McvValidationErrors from "@/components/ValidationErrors";
import {actionTypes} from "@/store/modules/auth";


export default {
    name: "McvLogin",
    components: {McvValidationErrors},
    data(){
        return {
            email: '',
            password: '',
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
            this.$store.dispatch(actionTypes.login, {
                email: this.email,
                password: this.password,
            }).then(() => {
                this.$router.push({name: 'global_feed'})
            })
        }
    }
}
</script>

<style scoped>
/* просмотрел: модуль 2 - видео 5. Добавляем API запрос на регистрацию.mp4 */
</style>
