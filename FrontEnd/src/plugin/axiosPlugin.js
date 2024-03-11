// axiosPlugin.js
import axios from 'axios';
import {useSetupStore} from "@/stores/setupStore.js";

function getToken(){
    return localStorage.getItem('token')
}

export const axiosPlugin = {
    install(app) {
        // Create an axios instance
        const setup = useSetupStore()

        const httpClient = axios.create({
            baseURL: setup.host, // Set your base URL
            headers: {
                'Content-Type': 'application/json',
            },
        });


        // Set authorization header if needed
        httpClient.interceptors.request.use(config => {
            const token = getToken();

            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }

            return config;
        });


        // Provide axios instance as global property
        app.config.globalProperties.$server = httpClient;
    },
};