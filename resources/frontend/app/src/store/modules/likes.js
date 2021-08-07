import likingApi from '@/api/likes'

const state = {
  isLoading: false,
  errors: null,
}

export const mutationTypes = {
  addLikeStart: '[likes] Add like Start',
  addLikeSuccess: '[likes] Add like Success',
  addLikeFailure: '[likes] Add like Failure',
}

const mutations = {
  [mutationTypes.addLikeStart](state) {
    state.isLoading = true
    state.errors = null
  },
  [mutationTypes.addLikeSuccess](state) {
    state.isLoading = false
  },
  [mutationTypes.addLikeFailure](state, payload) {
    state.isLoading = false
    state.errors = payload
  },
}

export const actionTypes = {
  addLike: '[likes] Add like',
}

const actions = {
  [actionTypes.addLike](context, id) {
    return new Promise((resolve) => {
      context.commit(mutationTypes.addLikeStart)

      likingApi
        .liking(id)
        .then((response) => {
          console.log('success:', response)

          context.commit(mutationTypes.addLikeSuccess)
          resolve(response.data)
        })
        .catch((errors) => {
          context.commit(mutationTypes.addLikeFailure, errors.response.data)
        })
    })
  },
}

export default {
  state,
  actions,
  mutations,
}
