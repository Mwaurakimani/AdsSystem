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
const billings = ref([])
const active_bill = ref(null)

onBeforeMount(() => {
  server.get('/api/loadBillingPage')
      .then(({data:{bills}}) => billings.value = bills)
      .catch(error => console.log(error))
})

</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Billing'"></DashboardHeading>

    <ul class="stats-display">
      <li class="bg-red-400 text-white">
        <h3>Monthly Bill</h3>
        <h2>Ksh 100,000</h2>
      </li>
      <li class="bg-orange-300 text-white">
        <h3>Available Balance</h3>
        <h2>Ksh 100,000</h2>
      </li>
    </ul>

    <div class="container flex gap-x-2">
      <div class="w-[300px] h-[100%] ">
        <ul>
          <BillingListComponent
              v-for="bill in billings" :bill
          />
        </ul>
      </div>
      <div class="w-[calc(100%_-_300px)] h-[100%] bg-white shadow">
        <div class="bg-red-400 w-full h-[300px] mb-[30px]">

        </div>
        <div class="column px-[10px] pb-[30px]">
          <div class="flex justify-between mb-[20px]">
            <h2 class="font-semibold text-2xl">00/00/0000</h2>
          </div>
          <div class="mb-[30px]">
            <p class="mb-[20px]">Billing as from 00/00/0000 to 00/00/0000 for x views and X clicks is</p>
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

.stats-display{
  @apply flex w-full justify-between mb-[30px];


  li{
    @apply w-[30%] h-[100px] border rounded flex flex-col justify-center gap-2.5 px-[30px] shadow-sm;

    h3{
      @apply font-semibold text-[20px]
    }

    h2{
      @apply font-semibold text-[25px]
    }

  }
}
</style>
