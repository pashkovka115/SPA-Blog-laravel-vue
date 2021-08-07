import popularTagsApi from "@/api/popularTags";


const state = {
    data: null,
    isLoading: false,
    error: null
}


export const mutationTypes = {
    getPopularTagsStart: '[PopularTags] Get PopularTags Start',
    getPopularTagsSuccess: '[PopularTags] Get PopularTags Success',
    getPopularTagsFailure: '[PopularTags] Get PopularTags Failure',
}

export const actionTypes = {
    getPopularTags: '[PopularTags] Get PopularTags'
}

const mutations = {
    [mutationTypes.getPopularTagsStart](state){
        state.isLoading = true
        state.data = null
    },
    [mutationTypes.getPopularTagsSuccess](state, payload){
        state.isLoading = false
        state.data = payload
    },
    [mutationTypes.getPopularTagsFailure](state){
        state.isLoading = false
    }
}

const actions = {
    [actionTypes.getPopularTags](context){
        return new Promise(resolve => {
            context.commit(mutationTypes.getPopularTagsStart)

            popularTagsApi.getPopularTags()
                .then(response => {
                    context.commit(mutationTypes.getPopularTagsSuccess, response.data)
                    resolve(response.data)
                })
                .catch(()=>{
                    context.commit(mutationTypes.getPopularTagsFailure)
                })
        })
    }
}

export default {
    state,
    actions,
    mutations
}
