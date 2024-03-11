<script setup>
import CreatorLayout from "@/components/Layouts/CreatorLayout.vue";
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import {useRouter} from 'vue-router'
import {onBeforeMount, ref} from "vue";
import {useServer} from "@/composables/server.js";

const router = useRouter()
const server = useServer()


const pages = ref([])
const current_page = ref(null)
const loading = ref(true)

onBeforeMount( () => {
  server.get('/api/pages')
      .then((resp) => {

        pages.value = resp.data.data

        loading.value = false
      })
      .catch((err) => {
        loading.value = false
      })
})
</script>

<template>
  <creator-layout>
    <DashboardHeading :page-title="'Pages'"></DashboardHeading>
    <div class="action-bar bg-white mb-[10px] py-[5px] px-[10px] flex justify-between">
      <div>
        <ul class="flex  space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({ name: 'CreatePage' })">Create New</button>
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
    <div class="w-[100%] border bg-white mb-[10px]">
      <table class="table p-0 table-sm text-sm table-hover">
        <thead class="bg-blue-500 text-white">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Domain</th>
          <th scope="col">Path</th>
          <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in pages" @click="router.push({name:'ViewPage',params:{id:item.id}})" >
          <th>{{item.id}}</th>
          <td>{{item.title}}</td>
          <td>{{item.domain}}</td>
          <td>{{item.path}}</td>
          <td>{{item.status}}</td>
        </tr>
        </tbody>
      </table>
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
  </creator-layout>
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
