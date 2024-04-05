<template>
  <li class="grid shadow rounded-sm">
    <p class="col-start-1 col-span-1 row-start-1">From</p><span
      class="col-start-2 col-span-1 row-start-1">: usernames</span>
    <p class="col-start-1 col-span-1 row-start-2">Date</p><span
      class="col-start-2 col-span-1 row-start-2">: 00/00/0000</span>
  </li>
</template>
<script>
export default {
  name: 'BillingListComponent'
}
</script>
<style scoped lang="scss">

li{
  @apply bg-white p-[10px] mb-[10px]
}
</style>