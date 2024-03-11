import { getCurrentInstance } from 'vue'

export function useServer () {
    const app = getCurrentInstance()
    return app.appContext.config.globalProperties.$server
}