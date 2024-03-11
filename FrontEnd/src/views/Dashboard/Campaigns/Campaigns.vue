<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import { useRouter } from 'vue-router'
import {onBeforeMount, reactive, ref} from "vue";
import {useServer} from "@/composables/server.js";
import dateFormatter from "../../../composables/dateFormatter.js";

const router = useRouter()
const server = useServer()

function createCampaign() {
  router.push({ name: 'MarketingCampaignsCreate' })
}

const campaigns = ref([])
const current_page = ref(null)
const loading = ref(true)

onBeforeMount( () => {

  server.get('/api/campaign')
      .then((resp) => {
        campaigns.value = resp.data.data
        current_page.value = resp.data.data
      }).catch((err) => {
        console.log(err)
      }).finally(() => {
        loading.value = false
      })

})

</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>
    <div class="action-bar bg-white mb-[10px] py-[5px] px-[10px] flex justify-between">
      <div>
        <ul class="flex  space-x-2">
          <li>
            <button class="text-sm" @click.prevent="createCampaign">Create New</button>
          </li>
          <li>
            <button class="text-sm">View Active</button>
          </li>
          <li>
            <button class="text-sm">View Inactive</button>
          </li>
        </ul>
      </div>
      <div class="flex space-x-2">
        <input type="search" class="border rounded" />
        <button class="text-sm">Search</button>
      </div>
    </div>

    <div v-if="loading" class="w-[100%]  mb-[10px] py-[20px] flex items-center justify-center">
      <div class="rounded-[50%] w-[30px] h-[30px]  border-blue-400 spinner">
      </div>
    </div>
    <div v-else class="w-[100%] border bg-white mb-[10px]">
      <table v-if="campaigns.length > 0" class="table p-0 table-sm text-sm table-hover">
        <thead class="bg-blue-500 text-white">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Created at</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in campaigns" @click="router.push({name:'viewCampaign',params:{id:item.id}})" >
            <th>{{item.id}}</th>
            <td>{{item.title}}</td>
            <td>{{dateFormatter(item.created_at)}}</td>
            <td>{{item.status}}</td>
          </tr>
        </tbody>
      </table>
      <div v-else class="p-[20px] flex items-center justify-center">
        <h1 class="text-gray-500">No data was found</h1>
      </div>
    </div>
    <div>
      <nav aria-label="Page bg-white navigation">
        <ul class="pagination pagination-sm">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
  </marketer-layout>
</template>

<style scoped>
tr {
  cursor: pointer;
}

button {
  background-color: transparent;
  @apply text-blue-400 border border-blue-400 hover:bg-blue-500 hover:text-white;
}
</style>
