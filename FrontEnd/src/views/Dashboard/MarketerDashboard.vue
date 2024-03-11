<script setup>
import MarketerLayout from "@/components/Layouts/MarketerLayout.vue";
import DashboardHeading from "@/components/DashboardComponents/DashboardHeading.vue";
</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Dashboard'"></DashboardHeading>
    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div class="flex space-x-2 mb-[10px]">
        <input type="date" class="border w-[200px] rounded px-[10px] ">
        <button class="text-sm">Apply</button>
        <button class="text-sm">Reset</button>
      </div>
    </div>
    <div class="w-[100%] flex justify-between">
      <div class="w-[69%]">
        <div class="w-[100%] h-[300px] rounded bg-red-400 mb-[30px]">
          <p>Chart Area</p>
        </div>
        <div class="w-[100%] h-[300px] rounded bg-blue-400">
          <p>List Area</p>
        </div>
      </div>
      <div class="w-[30%] bg-blue-500 rounded h-[600px]">
        <p>Side section</p>
      </div>
    </div>
  </marketer-layout>
</template>

<style scoped>

</style>