import 'vue-toastification/dist/index.css'
import Toast from 'vue-toastification'
import { useToast } from 'vue-toastification'

export default {
  install(app) {
    app.use(Toast, {
      position: 'top-right',
      timeout: 3000,
      closeOnClick: true,
      pauseOnFocusLoss: true,
      pauseOnHover: true,
      draggable: true,
      draggablePercent: 0.6,
      showCloseButtonOnHover: false,
      hideProgressBar: false,
      closeButton: 'button',
      icon: true,
      rtl: false,
    })

    app.config.globalProperties.$toast = useToast()
  },
}
