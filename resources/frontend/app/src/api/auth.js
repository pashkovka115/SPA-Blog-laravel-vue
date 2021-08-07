import axios from '@/api/axios'

const register = (credentials) => {
  return axios.post('/register', credentials)
}

const login = (credentials) => {
  return axios.post('/login', credentials)
}

const getCurrentUser = () => {
  return axios.get('/user')
}

const updateCurrentUser = (currentUserInput) => {
  return axios.post('/user', {
    _method: 'PUT',
    ...currentUserInput,
  })
}

const logout = () => {
  return axios.post('/logout')
}

export default {
  register,
  login,
  getCurrentUser,
  updateCurrentUser,
  logout,
}
