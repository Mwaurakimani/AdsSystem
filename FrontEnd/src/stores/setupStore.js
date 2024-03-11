import {defineStore} from "pinia";


export const useSetupStore = defineStore('useSetupStore',{
    state:() => ({
        url:"http://127.0.0.1",
        port:"8001"
    }),

    getters:{
        host:(state) => {
            return state.url+":"+state.port
        }
    },
    actions:{
    }
})