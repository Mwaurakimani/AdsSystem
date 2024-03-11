<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import { useRouter } from 'vue-router'

const router = useRouter()
</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>
    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({name:'viewCampaign',params:{id:1}})">View Campaign</button>
          </li>
        </ul>
      </div>
      <div class="flex space-x-2">
        <button class="text-sm">Download Statistics</button>
      </div>
    </div>

    <div class="w-[100%] flex text-sm space-x-2">
      <div class="w-2/3 h-[300px]">
        <div class="w-[100%] border bg-white shadow-md mb-[10px]">
          <table class="table p-0 table-sm text-sm table-hover">
            <thead class="bg-blue-500 text-white">
            <tr>
              <th scope="col">Entry ID</th>
              <th scope="col">Title</th>
              <th scope="col">Views</th>
              <th scope="col">Clicks</th>
              <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in 10" @click="router.push({name:'viewCampaign',params:{id:1}})" >
              <th>1</th>
              <td>Page title</td>
              <td>300</td>
              <td>100</td>
              <td>Active</td>
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
      </div>

      <div class="w-1/3 h-[300px]">

        <div class="bg-white shadow-md p-[10px]">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Stats</h3>
          </div>

          <ul class="p-[10px]">
            <li class="flex">
              <label class="w-[110px]">Title</label>
              <p>Campaign Title</p>
            </li>
            <li class="flex">
              <label class="w-[110px]">Status</label>
              <p>Active</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </marketer-layout>
</template>

<style scoped>
input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>