<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import {useRouter} from "vue-router";
import CreatorLayout from "@/components/Layouts/CreatorLayout.vue";
import {ref} from "vue";
import {useServer} from "@/composables/server.js";

const router = useRouter()
const server = useServer()


const page = ref({
  title:'Computer Article',
  domain:'http://localhost:5173',
  path:'/creator/pages/create'
})

function submitPage(){
  server.post('/api/pages/create',page.value)
      .then((resp) => {
        alert(resp.data.message)
        router.push({name:'CreatorPages'})
      })
      .catch((err)=>{
        console.log(err.data)
      })
}

</script>

<template>
  <creator-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>

    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({name:'CreatorPages'})">View All Pages</button>
          </li>
        </ul>
      </div>
    </div>

    <form class="w-[100%] flex text-sm space-x-2">

      <div class="w-2/3 h-[300px]">

        <div class="p-[20px] mb-[30px] bg-white shadow-md">

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Title</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="page.title"/>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Domain</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="page.domain" />
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Path</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="page.path" />
            </div>
          </div>

        </div>

      </div>

      <div class="w-1/3 h-[300px]">

        <div class="bg-white shadow-md p-[10px]">
          <button class="text-sm w-[100%]" @click.prevent="submitPage">Save</button>
        </div>

      </div>

    </form>
  </creator-layout>
</template>

<style scoped>
input[type='text'] {
  width: 100%;
  @apply p-[5px] rounded;
}

label{
  color: grey;
}
</style>