import { defineBoot } from '#q-app/wrappers'
import axios from 'axios'

export default defineBoot(() => {
  axios.defaults.baseURL = 'http://127.0.0.1:8002/api'

  axios.interceptors.request.use(config => {
    const token = localStorage.getItem('access_token') || sessionStorage.getItem('access_token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  }, error => Promise.reject(error))

  axios.interceptors.response.use(
    response => response,
    error => {/* 
        localStorage.removeItem('access_token')
        localStorage.removeItem('user')
        window.location.href = '/login' */
      return Promise.reject(error)
    },
  )
})

export { axios }