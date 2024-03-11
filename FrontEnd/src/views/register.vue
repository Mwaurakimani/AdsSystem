<script setup>
import { useRouter } from 'vue-router'
import { useServer } from '@/composables/server.js'
import { reactive } from 'vue'
import {useSetupStore} from "@/stores/setupStore.js";
import {formatErrors,errorsValues} from "@/composables/serverFromatter.js";

const router = useRouter()
const setup = useSetupStore()
const server = useServer()
const content = reactive({
  username: '',
  email: '',
  accountType: '',
  password: '',
  confirm_password: ''
})


function register() {

  for (const key in errorsValues) {
    delete errorsValues[key];
  }

  setup.$patch({
    port:'100'
  })

  server
    .post('/api/register', {... content })
    .then((res) => {
      alert(res.data.message)
      router.push({name:'home'})
    })
    .catch((err) => {
      formatErrors(err)
    })
}
</script>

<template>
  <div class="flex w-[100vw] h-[100vh] bg-gray-600 items-center justify-center">
    <div class="bg-white shadow-md h-fit w-[500px] rounded">
      <h1 class="font-semibold p-[10px] text-gray-700">Sign In</h1>
      <form>
        <div class="px-[60px]">
          <div class="input-group">
            <label>Username</label>
            <input type="text" placeholder="Username" v-model="content.username" />
            <p v-if="errorsValues.username" class="text-red-400 text-right text-sm">{{errorsValues?.username[0]}}</p>
          </div>
          <div class="input-group">
            <label>Email</label>
            <input type="email" placeholder="Email" v-model="content.email" />
            <p v-if="errorsValues.email" class="text-red-400 text-right text-sm">{{errorsValues?.email[0]}}</p>
          </div>
          <div class="input-group">
            <label>Account Type</label>
            <select v-model="content.accountType">
              <option value="" selected></option>
              <option value="marketer">Marketer</option>
              <option value="creator">Creator</option>
            </select>
            <p v-if="errorsValues.accountType" class="text-red-400 text-right text-sm">{{errorsValues?.accountType[0]}}</p>
          </div>
          <div class="input-group">
            <label>Password</label>
            <input type="password" placeholder="Password" v-model="content.password" />
            <p v-if="errorsValues.password" class="text-red-400 text-right text-sm">{{errorsValues?.password[0]}}</p>
          </div>
          <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" placeholder="Password" v-model="content.confirm_password" />
            <p v-if="errorsValues.confirm_password" class="text-red-400 text-right text-sm">{{errorsValues?.confirm_password[0]}}</p>
          </div>
        </div>
        <div class="flex items-center justify-around py-[20px]">
          <button @click.prevent="register">Register</button>
          <button @click.prevent="router.push({ name: 'home' })">Sign In</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
@import 'src/assets/scss/index.scss';

h1 {
  @apply mb-[10px] p-[20px];
}

label {
  @apply font-semibold;
}

.input-group {
  @apply flex flex-col mb-[20px];

  input,
  select {
    border: none !important;
    @apply bg-gray-300 rounded h-[30px] py-[3px] px-[10px] outline-blue-400 focus:bg-white focus:text-gray-600 transition-all duration-300;
  }
}
</style>
