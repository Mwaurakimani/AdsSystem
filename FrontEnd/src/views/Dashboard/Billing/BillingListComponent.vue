<script setup>
const props = defineProps(['bill'])
</script>

<template>
  <li class="grid shadow-sm rounded-sm">
    <p class="col-start-1 col-span-1 row-start-1">From</p><span
      class="col-start-2 col-span-1 row-start-1">: {{bill.start_date}}</span>
    <p class="col-start-1 col-span-1 row-start-2">To</p><span
      class="col-start-2 col-span-1 row-start-2">: {{bill.end_date}}</span>
  </li>
</template>
<script>
export default {
  name: 'BillingListComponent'
}
</script>
<style scoped lang="scss">

li{
  @apply bg-white p-[10px] mb-[5px] hover:bg-blue-400 hover:text-white hover:cursor-pointer
}
</style>