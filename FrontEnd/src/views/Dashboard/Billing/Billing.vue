<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import {useRouter} from 'vue-router'
import {onBeforeMount, ref} from "vue";
import {useServer} from "@/composables/server.js";
import BillingListComponent from "@/views/Dashboard/Billing/BillingListComponent.vue";

const router = useRouter()
const server = useServer()

function createCampaign() {
  router.push({name: 'MarketingCampaignsCreate'})
}

const campaigns = ref([])
const current_page = ref(null)
const loading = ref(true)

onBeforeMount(() => {

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
    <DashboardHeading :page-title="'Billing'"></DashboardHeading>
    <div class="container flex gap-x-2">
      <div class="w-[300px] h-[100%] ">
        <ul>
          <BillingListComponent/>
          <BillingListComponent/>
          <BillingListComponent/>
          <BillingListComponent/>
          <BillingListComponent/>
          <BillingListComponent/>
        </ul>
      </div>
      <div class="w-[calc(100%_-_300px)] h-[100%] bg-white shadow">
        <div class="column px-[10px] pb-[30px]">
          <div class="flex justify-between mb-[20px]">
            <h2 class="font-semibold text-2xl">User</h2>
            <h2 class="font-semibold text-2xl">Date</h2>
          </div>
          <div class="mb-[30px]">
            <p class="mb-[20px]">Billing as at 00/00/0000 for x views and X clicks is</p>
            <p class="font-bold">Ksh 00,000</p>
          </div>
          <div>
            <button @click.prevent="makePayment" class="btn btn-primary-fill">Make payment</button>
          </div>
        </div>
      </div>
    </div>
  </marketer-layout>
</template>

<style scoped lang="scss">
tr {
  cursor: pointer;
}

th,td {
  @apply px-[10px] py-[10px];
}

button {
  background-color: transparent;
  @apply text-blue-400 border border-blue-400 hover:bg-blue-500 hover:text-white;
}
</style>
