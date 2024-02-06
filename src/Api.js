import axios from 'axios'

const Api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true
})

Api.interceptors.request.use(config => {

  config.headers['Access-Control-Allow-Origin'] = '*'
  config.headers['X-Requested-With'] = 'XMLHttpRequest'
  config.headers['Content-Type'] = 'application/json'

  const AccessToken = localStorage.getItem('token')

  if (AccessToken) {
    config.headers['Authorization'] = `Bearer ${AccessToken}`
  }

  if (config.params != null) {
    for (const key in config.params) {
      if (config.params[key] == "" || config.params[key] == null) {
        config.params[key] == false ? '' : delete config.params[key];
      }
    }
  }

  if (config.data != null && Array.from(config.data).filter(([key, value]) => value == '' || value == null || value == 'null').length > 0) {
    Array.from(config.data).filter(([key, value]) => value == '' || value == null || value == 'null' ? config.data.delete(key) : '')
  }

  return config

}, error => Promise.reject(error))

Api.interceptors.response.use(response => {
  return response
}, error => {
  if (error.response.status == 401 && error.config.url != '/auth/login') {
    localStorage.removeItem('token')
    localStorage.removeItem('userData')

    window.location.href = '/'

  }

  return Promise.reject(error)

})

export default Api
