import axios from '@/api/axios'

const getArticle = (slug) => {
  return axios.get(`/articles/${slug}`) //.then(response => {response})
}

const deleteArticle = (slug) => {
  return axios.post(`/articles/${slug}`, {
    _method: 'DELETE',
  })
}

const createArticle = (articleInput) => {
  return axios.post('/articles', {...articleInput})
  //.then((response) => response.data)
}

const updateArticle = (slug, articleInput) => {
  return axios.post(`/articles/${slug}/edit`, {
    _method: 'PUT',
    ...articleInput,
  })
}

export default {
  getArticle,
  deleteArticle,
  createArticle,
  updateArticle,
}
