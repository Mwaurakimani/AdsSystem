<script setup>

</script>

<template>
  <nav class="h-[60px] shadow flex px-[10px] justify-between">
    <div class="h-[100%] w-[100px] text-[1.3em] flex items-center justify-center">
      logo
    </div>
    <ul class="h-[100%] flex items-center justify-around space-x-2">
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/About">About</router-link></li>
      <li><router-link to="/Blog">Blog</router-link></li>
    </ul>
    <div class="h-[100] w-[100px]"></div>
  </nav>
</template>

<style scoped lang="scss">
li{
  @apply p-[5px];

  &:hover{
    color: white;
    background-color: dodgerblue;
    transition: all ease-in 100ms;
    @apply rounded;
  }
}
</style>