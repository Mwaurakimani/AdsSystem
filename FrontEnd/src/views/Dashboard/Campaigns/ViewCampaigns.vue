<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import {useRoute, useRouter} from 'vue-router'
import AppPill from "@/components/AppComponents/AppPill.vue";
import {onBeforeMount, reactive, ref} from "vue";
import {useServer} from "@/composables/server.js";
import dateFormatter from "../../../composables/dateFormatter.js";
import {useSetupStore} from "@/stores/setupStore.js";

const router = useRouter()
const route = useRoute()
const server = useServer()
const useSetup = useSetupStore()

const campaign = reactive({})
const loading = ref(true)

onBeforeMount( () => {
  server.get('/api/campaign/view/'+route.params.id)
      .then((resp) => {

        Object.keys(resp.data).forEach(key => {
          campaign[key] = resp.data[key];
        });

        loading.value = false
      })
      .catch((err) => {

        console.log(err.data)
        loading.value = false
      })
})
</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>
    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({name:'MarketingCampaigns'})">View All Campaigns</button>
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
          <div class="flex space-x-2 justify-between">
            <h3 class="font-semibold">{{campaign.title}}</h3>
            <div class="flex space-x-3 justify-between">
              <label>Display Type:</label>
              <p>{{campaign.campaign_type}}</p>
            </div>
          </div>

          <div class="image-display  my-[20px]">
            <div v-if="campaign.campaign_type">
              <img class="w-[100%] flex max-h-[100%]" :src="useSetup.host+'/storage/'+campaign.upload.replace(/^public\//, '')">
            </div>
          </div>

          <ul>
            <li class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Display Area</label>
              <p>{{campaign.display_type}}</p>
            </li>
            <li v-if="campaign.display_on" class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Display On</label>
              <ul>
                <li v-for="item in JSON.parse(campaign.display_on)">{{item}}</li>
              </ul>
            </li>
            <li v-if="campaign.from_start || campaign.from_end" class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Display Time</label>
              <div class="flex space-x-3">
                <p>{{campaign.from_start}}</p>
                <span v-if="campaign.from_end"> To</span>
                <p>{{campaign.from_end}}</p>
              </div>
            </li>
            <li v-if="campaign.redirect_link" class="flex mb-[10px]">
              <label class="font-semibold text-gray-500 w-[110px]">Redirect Link</label>
              <a class="text-blue-500" href="/">{{campaign.redirect_link}}</a>
            </li>
          </ul>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[20px]">
            <h3 class="font-semibold">Tags</h3>
          </div>
          <ul class="flex gap-1 flex-wrap">
            <app-pill v-for="tag in JSON.parse(campaign.tags)" :pill-name="tag" />
          </ul>
        </div>
      </div>

      <div class="w-1/3 h-[300px]">
        <div class="bg-white shadow-md p-[10px] mb-[20px]">
          <button class="text-sm w-[100%] mb-[10px]" @click.prevent="router.push({name:'ViewStats'})" >Stats</button>
          <button
            class="text-sm w-[100%] bg-orange-400 mb-[10px]"
            @click.prevent="router.push({ name: 'editCampaigns', params: { id: campaign.id } })"
          >
            Edit
          </button>
          <button class="text-sm w-[100%] bg-red-400 mb-[10px]">Delete</button>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Billing</h3>
          </div>
          <ul class="p-[10px]">
            <li class="flex">
              <label class="w-[110px]">Current Spent</label>
              <p>Ksh {{campaign.billing_spent}}</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Set Limit</label>
              <p>Ksh {{campaign.billing_limit}}</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Balance</label>
              <p>Ksh {{campaign.billing_limit - campaign.billing_spent}}</p>
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
              <p>{{campaign.status}}</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Date Created</label>
              <p>{{dateFormatter(campaign.created_at)}}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </marketer-layout>
</template>

<style scoped>
input{
  @apply px-[5px]
}

input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>