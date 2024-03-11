<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import {useRoute, useRouter} from 'vue-router'
import CreatorLayout from '@/components/Layouts/CreatorLayout.vue'
import AppPill from "@/components/AppComponents/AppPill.vue";
import {useServer} from "@/composables/server.js";
import {onBeforeMount, provide, ref} from "vue";
import EditTags from "@/views/Dashboard/Campaigns/EditTags.vue";

const router = useRouter()
const route = useRoute()
const server = useServer()
const page = ref({})
const loading = ref(true)

onBeforeMount(() => {
  server.get('/api/pages/view/' + route.params.id)
      .then((resp) => {

        page.value = resp.data
        page.value.tags = resp.data.tags != null? JSON.parse(resp.data.tags) : []

        loading.value = false

      })
      .catch((err) => {

        console.log(err.data)

        loading.value = false

      })
})

function updatePage(){

  server.post('/api/pages/update/' + route.params.id,page.value)
      .then((resp) => {
        alert(resp.data.message)
        router.push({name:'ViewPage',params:{id:route.params.id}})
      })
      .catch((err) => {
        console.log(err)
      })
}

const addTag = (tag) => {
  page.value.tags.push(tag)
}

const removeTagParent = (remove) => {
  page.value.tags = page.value.tags.filter(tag => tag !== remove);
};

provide('removeTagParent',removeTagParent)
provide('addTag',addTag)
</script>

<template>
  <creator-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>

    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({ name: 'CreatorPages' })">View All Pages</button>
            <button class="text-sm mx-[10px]"  @click="router.push({name:'ViewPage',params:{id}})">View Page</button>
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
              <input type="text" class="border" v-model="page.title" />
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

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Status</label>
            <div class="w-4/6">
              <input type="radio" value="active" class="mr-[10px]" v-model="page.status" />Active<br />
              <input type="radio" value="inactive" class="mr-[10px]" v-model="page.status" />Inactive<br />
            </div>
          </div>
        </div>
        <EditTags :tags="page.tags"/>
      </div>

      <div class="w-1/3 h-[300px]">
        <div class="bg-white shadow-md p-[10px]">
          <button class="text-sm w-[100%]" @click.prevent="updatePage">Save</button>
        </div>
      </div>
    </form>
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