<script setup>
import MarketerLayout from "@/components/Layouts/MarketerLayout.vue";
import DashboardHeading from "@/components/DashboardComponents/DashboardHeading.vue";
import {useServer} from "@/composables/server.js";
import {ref, unref} from "vue";

const server = useServer()
const dataSet = ref(null)

$(document).ready(
    async () => {
      google.charts.load('current', {'packages': ['corechart', 'bar']})

      try {
        let {data: {Pages}} = await server.post('/api/campaign/getMarketerStats')

        const extractedData = Object.entries(Pages).map(
            ([key, value]) => {
              const {title, clicks, views} = value
              return [title, clicks, views]
            })

        if (extractedData.length > 0) {
          //add heading
          extractedData.unshift(['Page', 'clicks', 'views'])

          //bind to responsive dataset
          dataSet.value = [...extractedData]

          //draw chard
          google.charts.setOnLoadCallback(drawChart);
        }
      } catch (error) {
        console.log(error)
      }

    }
)

function drawChart() {
  $(document).ready(() => {
    let displayDataset = Object.values(dataSet.value)

    let data = new google.visualization.arrayToDataTable(displayDataset);

    let options = {
      title: 'Motivation and Energy Level Throughout the Day',
    }

    var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
    materialChart.draw(data, options);
  })

}
</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Dashboard'"></DashboardHeading>
    <div class="w-[100%] flex justify-between">
      <div class="w-[69%]">
        <div class="w-[100%] shadow-sm h-[300px] bg-white  rounded overflow-hidden mb-[30px]">
          <h1 class="p-[10px] text-blue-500">Performing Pages</h1>
          <div class="contain h-[100%] px-[30px]">
            <div v-if="dataSet != null" style="height: 90% !important; padding: 2px"
                 id="chart_div"></div>
            <div v-else class="flex justify-center items-center p-[20px] text-[20px] font-semibold text-gray-500">No
              data available
            </div>
          </div>
        </div>
        <!--        <div class="w-[100%] h-[300px] rounded bg-blue-400">-->
        <!--          <p>List Area</p>-->
        <!--        </div>-->
      </div>
      <div class="w-[30%] shadow rounded h-fit pb-[10px] bg-white">
        <h1 class="mb-[1px] p-[10px] text-blue-500">Top Clicked Sites</h1>
        <ul v-if="dataSet != null ">
          <li v-for="(item,index) in dataSet" class="hover:bg-blue-500 hover:text-white border-b">
            <div v-if="index !== 0" class="w-[90%]   py-[10px] mx-auto mb-[1px] flex justify-between px-[5px]">
              <p>{{ item[0] }}</p>
              <p>{{ item[1] }}</p>
            </div>
          </li>
        </ul>
        <div v-else class="flex justify-center items-center p-[20px] text-[20px] font-semibold text-gray-500">No data
          available
        </div>
      </div>
    </div>
  </marketer-layout>
</template>

<style scoped>

</style>