import axios from "axios";

const Api = axios.create({
  baseURL: import.meta.env.VITE_API_URL
});

Api.interceptors.request.use((config) => {

  config.headers['Access-Control-Allow-Origin'] = '*'
  config.headers['X-Requested-With'] = 'XMLHttpRequest'

  if (config.params != null) {
    for (const key in config.params) {
      if (config.params[key] == '' || config.params[key] == null) {
        config.params[key] == false ? '' : delete config.params[key]
      }
    }
  }

  if (config.data != null && Array.from(config.data).filter(([key, value]) => value == '' || value == null || value == 'null').length > 0 ) {
    Array.from(config.data).filter(([key, value]) => {
      value == '' || value == null || value == 'null' ? config.data.delete(key) : ''
    })
  }

  return config

}, (error) => Promise.reject(error))

export default Api
