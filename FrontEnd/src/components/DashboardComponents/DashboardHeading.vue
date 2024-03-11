<script setup>
import {useRouter} from "vue-router";
import {useServer} from "@/composables/server.js";

const props = defineProps(['pageTitle'])
const router = useRouter();

let server = useServer();

function logOut() {
  server
      .post('/api/logout')
      .then((resp) => {
        localStorage.clear();
        router.push({name:'home'})
      })
      .catch((err) => {
        console.log(err)
      })
}

</script>

<template>
  <div class="dashboard-heading py-[10px] px-[10px] flex justify-between items-center">
    <h3 class="text-[1.5em]">{{ props.pageTitle }}</h3>
    <button class="text-sm" @click.prevent="logOut">Log Out</button>
  </div>
</template>

<style scoped>
.dashboard-heading {
  @apply mb-[20px]
}
</style>