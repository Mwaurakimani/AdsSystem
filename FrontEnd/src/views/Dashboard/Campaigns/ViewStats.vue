<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import {useRoute, useRouter} from 'vue-router'
import {ref} from "vue";
import {useServer} from "@/composables/server.js";

const router = useRouter()
let route = useRoute();
let server = useServer()
const campaign_id = ref(route.params.id)
const statsDataset = ref([])

server.post('/api/campaign/getCampaignStats/' + campaign_id.value)
    .then(({data: {stats}}) => {
      statsDataset.value = stats
    })
    .catch((err) => {
      console.log(err)
    })


async function downloadStats() {
  let {data: {stats}} = await server.post('/api/campaign/downloadStats/' + campaign_id.value)

// Function to convert JSON to CSV
  function convertToCSV(objArray) {
    const array = typeof objArray !== 'object' ? JSON.parse(objArray) : objArray;
    let str = '';

    // Headers
    const headers = Object.keys(array[0]);
    str += headers.join(',') + '\r\n';

    // Rows
    for (let i = 0; i < array.length; i++) {
      let line = '';
      for (let j = 0; j < headers.length; j++) {
        if (line !== '') line += ',';
        line += array[i][headers[j]];
      }
      str += line + '\r\n';
    }
    return str;
  }

  // Convert JSON to CSV
  const csvData = convertToCSV(stats);

  // Create a blob object from CSV data
  const blob = new Blob([csvData], {type: 'text/csv'});

  // Create a link element
  const link = document.createElement('a');
  link.href = window.URL.createObjectURL(blob);
  link.download = 'data.csv'; // Set the filename here

  // Append the link to the body
  document.body.appendChild(link);

  // Trigger the download
  link.click();

  // Clean up
  document.body.removeChild(link);


}


</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>
    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({name:'viewCampaign',params:{id:1}})">Back to Campaign</button>
          </li>
        </ul>
      </div>
      <div class="flex space-x-2">
        <button v-if="statsDataset && statsDataset.length > 0" @click.prevent="downloadStats" class="text-sm">Download Statistics</button>
      </div>
    </div>

    <div class="w-[100%] flex text-sm space-x-2">
      <div class="w-full h-[300px]">
        <div class="w-[100%] border bg-white shadow-md mb-[10px]">
          <table v-if="statsDataset && statsDataset.length > 0" class="table p-0 table-sm text-sm table-hover">
            <thead class="bg-blue-500 text-white">
            <tr>
              <th scope="col">Website</th>
              <th scope="col">Views</th>
              <th scope="col">Clicks</th>
              <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in statsDataset" @click="router.push({name:'viewCampaign',params:{id:1}})">
              <td>{{ item.website }}</td>
              <td>{{ item.views }}</td>
              <td>{{ item.clicks }}</td>
              <td>{{ item.status }}</td>
            </tr>
            </tbody>
          </table>
          <div v-else class="flex justify-center items-center p-[20px] text-[20px] font-semibold text-gray-500">No data available</div>
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
