import axios from '@/api/axios'

const liking = (id) => {
  return axios.post(`/post/${id}/like`)
}

export default {
  liking,
}
