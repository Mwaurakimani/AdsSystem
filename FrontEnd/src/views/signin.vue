<script setup>
import { useRouter } from 'vue-router'
import {useSetupStore} from "@/stores/setupStore.js";
import {useServer} from "@/composables/server.js";
import {formatErrors,errorsValues} from "@/composables/serverFromatter.js";
import {reactive} from "vue";

const router = useRouter()
const server = useServer()

const setup = useSetupStore()
const content = reactive({
  username:'',
  password:''
})

function login() {

  for (const key in errorsValues) {
    delete errorsValues[key];
  }

  server
      .post('/api/login', {... content })
      .then((response) => {
        // Extract token and user data from the response
        const { token, user } = response.data;

        // Save the token and user data to local storage or Vuex store
        localStorage.setItem('token', token);
        localStorage.setItem('user', JSON.stringify(user));

        if(user.accountType === 'marketer'){
          router.push({name:"MarketerDashboard"})
        }else if(user.accountType === 'creator'){
          router.push({name:"CreatorDashboard"})
        }else {
          alert("Admin")
        }
      })
      .catch((err) => {
        formatErrors(err)
      })
}
function register() {
  router.push({ name: 'register' })
}

</script>

<template>
  <div class="flex w-[100vw] h-[100vh] bg-gray-600 items-center justify-center">
    <div class="bg-white shadow-md h-fit w-[500px] rounded">
      <h1 class="font-semibold p-[10px] text-gray-700">Sign In</h1>
      <form>
        <div class="px-[60px]">
          <div class="input-group">
            <label>username</label>
            <input type="text" placeholder="username" v-model="content.username"/>
            <p v-if="errorsValues.username" class="text-red-400 text-right text-sm">{{errorsValues?.username[0]}}</p>
          </div>
          <div class="input-group">
            <label>Password</label>
            <input type="password" placeholder="Password" v-model="content.password"/>
            <p v-if="errorsValues.username" class="text-red-400 text-right text-sm">{{errorsValues?.password[0]}}</p>
          </div>
        </div>
        <div class="flex items-center justify-around py-[20px]">
          <button @click.prevent="login" type="submit">Sign In</button>
          <button @click.prevent="register" type="submit">Register</button>
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

  input {
    border: none !important;
    @apply bg-gray-300 rounded h-[30px] py-[5px] px-[10px] outline-blue-400 focus:bg-white focus:text-gray-600 transition-all duration-300;
  }
}
</style>