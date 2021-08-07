import authApi from '@/api/auth'
import {setItem} from '@/helpers/persistanceStorage'

const state = {
  isSubmitting: false,
  isLoading: false,
  currentUser: null,
  validationErrors: null,
  isLoggedIn: null,
}

export const mutationTypes = {
  registerStart: '[auth] registerStart',
  registerSuccess: '[auth] registerSuccess',
  registerFailure: '[auth] registerFailure',

  loginStart: '[auth] loginStart',
  loginSuccess: '[auth] loginSuccess',
  loginFailure: '[auth] loginFailure',

  getCurrentUserStart: '[auth] getCurrentUserStart',
  getCurrentUserSuccess: '[auth] getCurrentUserSuccess',
  getCurrentUserFailure: '[auth] getCurrentUserFailure',

  updateCurrentUserStart: '[auth] updateCurrentUserStart',
  updateCurrentUserSuccess: '[auth] updateCurrentUserSuccess',
  updateCurrentUserFailure: '[auth] updateCurrentUserFailure',

  logout: '[auth] logout',
}

export const actionTypes = {
  register: '[auth] register',
  login: '[auth] login',
  getCurrentUser: '[auth] getCurrentUser',
  updateCurrentUser: '[auth] updateCurrentUser',
  logout: '[auth] logout',
}

export const getterTypes = {
  currentUser: '[auth] currentUser',
  isLoggedIn: '[auth] isLoggedIn',
  isAnonymous: '[auth] isAnonymous',
}

const getters = {
  [getterTypes.currentUser]: (state) => {
    return state.currentUser
  },
  [getterTypes.isLoggedIn]: (state) => {
    return Boolean(state.isLoggedIn)
  },
  [getterTypes.isAnonymous]: (state) => {
    return state.isLoggedIn === false
  },
}

const mutations = {
  [mutationTypes.registerStart](state) {
    state.isSubmitting = true
    state.validationErrors = null
  },
  [mutationTypes.registerSuccess](state, payload) {
    state.isSubmitting = false
    state.currentUser = payload
    state.isLoggedIn = true
  },
  [mutationTypes.registerFailure](state, payload) {
    state.isSubmitting = false
    state.validationErrors = payload
  },

  [mutationTypes.loginStart](state) {
    state.isSubmitting = true
    state.validationErrors = null
  },
  [mutationTypes.loginSuccess](state, payload) {
    state.isSubmitting = false
    state.currentUser = payload
    state.isLoggedIn = true
  },
  [mutationTypes.loginFailure](state, payload) {
    state.isSubmitting = false
    state.validationErrors = payload
  },
  [mutationTypes.getCurrentUserStart](state) {
    state.isLoading = true
  },
  [mutationTypes.getCurrentUserSuccess](state, payload) {
    state.isLoading = false
    state.currentUser = payload
    state.isLoggedIn = true
  },
  [mutationTypes.getCurrentUserFailure](state) {
    state.isLoading = false
    state.isLoggedIn = false
    state.currentUser = null
  },
  [mutationTypes.updateCurrentUserStart]() {},
  [mutationTypes.updateCurrentUserSuccess](state, payload) {
    state.currentUser = payload
  },
  [mutationTypes.updateCurrentUserFailure]() {},
  [mutationTypes.logout](state) {
    state.currentUser = null
    state.isLoggedIn = false
  },
}

const actions = {
  [actionTypes.register](context, credentials) {
    return new Promise((resolve) => {
      context.commit(mutationTypes.registerStart)
      authApi
        .register(credentials)
        .then((response) => {
          let user = response.data.user
          user.token = response.data.token
          context.commit(mutationTypes.registerSuccess, user)
          setItem('accessToken', user.token)
          resolve(user)
        })
        .catch((error) => {
          context.commit(mutationTypes.registerFailure, error.response.data.errors)
        })
    })
  },

  [actionTypes.login](context, credentials) {
    return new Promise((resolve) => {
      context.commit(mutationTypes.loginStart)
      authApi
        .login(credentials)
        .then((response) => {
          let user = response.data.user
          user.token = response.data.token
          context.commit(mutationTypes.loginSuccess, user)
          setItem('accessToken', user.token)
          resolve(user)
        })
        .catch((error) => {
          context.commit(mutationTypes.loginFailure, error.response.data.errors)
        })
    })
  },

  [actionTypes.getCurrentUser](context) {
    return new Promise((resolve) => {
      context.commit(mutationTypes.getCurrentUserStart)
      authApi
        .getCurrentUser()
        .then((response) => {
          let user = response.data.data

          context.commit(mutationTypes.getCurrentUserSuccess, user)
          resolve(user)
        })
        .catch((error) => {
          context.commit(mutationTypes.getCurrentUserFailure)
        })
    })
  },

  [actionTypes.updateCurrentUser](context, currentUserInput) {
    return new Promise((resolve) => {
      context.commit(mutationTypes.updateCurrentUserStart)
      authApi
        .updateCurrentUser(currentUserInput)
        .then((response) => {
          context.commit(mutationTypes.updateCurrentUserSuccess, response.data.data)
          resolve(response.data)
        })
        .catch((error) => {
          context.commit(mutationTypes.updateCurrentUserFailure, error.response.data.errors)
        })
    })
  },
  [actionTypes.logout](context) {
    return new Promise((resolve) => {
      setItem('accessToken', '')
      context.commit(mutationTypes.logout)
      authApi.logout().then((response) => {
        resolve(response)
      })
    })
  },
}

export default {
  state,
  mutations,
  actions,
  getters,
}
