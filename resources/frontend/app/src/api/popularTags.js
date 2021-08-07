import axios from "@/api/axios";

const getPopularTags = () => {
    return axios.get('/tags').then(response => response)
}

export default {
    getPopularTags
}
