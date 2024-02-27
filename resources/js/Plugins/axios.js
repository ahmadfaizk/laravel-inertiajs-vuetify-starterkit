import axios from 'axios'

export default {
  install(app) {
    axios.defaults.timeout = 10000 // 10 seconds

    app.config.globalProperties.$axios = axios
  },
}
