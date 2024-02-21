import './assets/css/index.css'
import './assets/scss/index.scss'

import {createApp} from 'vue'
import { createPinia } from 'pinia'
import $ from 'jquery';

window.$ = $;

import App from './App.vue'
import router from './router'
import {axiosPlugin} from "@/plugin/axiosPlugin.js";
import {useServer} from "@/composables/server.js";
import {useRouter} from "vue-router";

const app = createApp(App)

app.use(createPinia())
app.use(axiosPlugin)
app.use(router)

app.mount('#app')
