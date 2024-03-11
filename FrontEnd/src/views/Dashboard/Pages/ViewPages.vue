<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import {useRoute, useRouter} from 'vue-router'
import Modal from '@/components/Layouts/Modal.vue'
import CreateAdd from '@/views/Dashboard/Pages/CreateAdd.vue'
import {onBeforeMount, onMounted, provide, ref} from 'vue'
import CreatorLayout from '@/components/Layouts/CreatorLayout.vue'
import AppPill from "@/components/AppComponents/AppPill.vue";
import {useServer} from "@/composables/server.js";
import dateFormatter from "../../../composables/dateFormatter.js";

const router = useRouter()
const route = useRoute()
const server = useServer()
const modal = ref(null)
const createAdd = ref(null)
const loading = ref(true)
const page = ref(null)
const activeAdSpace = ref(null)
const showModal = () => modal.value.openModel()
const loadPage = () => {
  server.get('/api/pages/view/' + route.params.id)
      .then((resp) => {
        page.value = resp.data
        page.value.tags = page.value.tags = resp.data.tags != null? JSON.parse(resp.data.tags) : []
      })
      .catch((err) => {
        console.log(err)
      })
      .finally(() => {
        loading.value = false
      })
}

onBeforeMount(loadPage)

function openAdSpace(id){
  activeAdSpace.value = id
  showModal()
}
function closeModal(){
  activeAdSpace.value = null
  createAdd.value.resetScript()
  loadPage()
}

function deleteAdSpace(id){
  server.delete('/api/delete/adSpace/'+id)
      .then((resp)=>{
        alert(resp.data.message)
        loadPage()
      })
      .catch((err)=>{
        console.log(err)
      })
}

provide('activeAdSpace',activeAdSpace)
provide('page',page)

</script>

<template>
  <teleport to="body">
    <Modal :heading="'Ad Section'" ref="modal" @closing-modal="closeModal">
      <create-add ref="createAdd"/>
    </Modal>
  </teleport>
  <creator-layout>
    <DashboardHeading :page-title="'Page'"></DashboardHeading>
    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({ name: 'CreatorPages' })">View All Campaigns</button>
          </li>
        </ul>
      </div>
    </div>

    <div v-if="loading" class="p-[20px] flex items-center justify-center">
      <div class="spinner"></div>
    </div>
    <div v-else class="w-[100%] flex text-sm space-x-2">
      <div class="w-2/3 h-[300px]">
        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[30px]">
            <h3 class="font-semibold">{{page.title}}</h3>
            <div class="flex space-x-3 justify-between">
              <label>Status: </label>
              <p>{{page.status}}</p>
            </div>
          </div>

          <ul>
            <li class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Domain</label>
              <p>{{page.domain}}</p>
            </li>
            <li class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Path</label>
              <p>{{page.path}}</p>
            </li>
          </ul>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[30px]">
            <h3 class="font-semibold">Ad Spaces</h3>
            <div class="flex space-x-3 justify-between">
              <button @click.prevent="showModal">Add Ad Space</button>
            </div>
          </div>
          <table class="table p-0 table-sm text-sm table-hover">
            <thead class="bg-blue-500 text-white">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Type</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr style="cursor: pointer" v-for="item in page.ad_spaces" @click="openAdSpace(item.id)">
              <th>{{item.id}}</th>
              <td>{{item.type}}</td>
              <td>{{item.status}}</td>
              <td class="w-[10%]"><button class="btn bg-red-400 text-sm text-white hover:bg-red-500" @click.prevent.stop="deleteAdSpace(item.id)">Delete</button></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="w-1/3 h-[300px]">
        <div class="bg-white shadow-md p-[10px] mb-[20px]">
          <button
              class="text-sm w-[100%] mb-[10px]"
              @click.prevent="router.push({ name: 'ViewStats' })"
          >
            Stats
          </button>
          <button
              class="text-sm w-[100%] bg-orange-400 mb-[10px]"
              @click.prevent="router.push({ name: 'UpdatePage', params: { id: 1 } })"
          >
            Edit
          </button>
          <button class="text-sm w-[100%] bg-red-400 mb-[10px]">Delete</button>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[20px]">
            <h3 class="font-semibold">Tags</h3>
          </div>
          <ul class="flex gap-1 flex-wrap">
            <app-pill v-for="tag in page.tags" :pill-name="tag" :disable-close="true"/>
          </ul>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Estimated Income</h3>
          </div>
          <ul class="p-[10px]">
            <li class="flex">
              <label class="w-[110px]">Current Made</label>
              <p>Ksh 150,000</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Active Time</label>
              <p>Ksh 300,000</p>
            </li>
          </ul>
        </div>

        <div class="bg-white shadow-md p-[10px]">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Stats</h3>
          </div>

          <ul class="p-[10px]">
            <li class="flex">
              <label class="w-[110px]">Status</label>
              <p>{{page.status}}</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Date Created</label>
              <p>{{dateFormatter(page.created_at)}}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </creator-layout>
</template>

<style scoped>
input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>
