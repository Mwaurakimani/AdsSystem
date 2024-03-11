<script setup>

import Navigation from "@/components/FrontEnd/navigation.vue";
import {useRouter} from "vue-router";


const router = useRouter()

function openArticle(id){
  router.push({name:'Article',params:{id}})
}
</script>

<template>
  <navigation class="mb-[30px]"></navigation>
  <div class="container">
    <h1 class="text-[1.4em] text-gray-700 font-semibold underline mb-[10px]" >Blog</h1>
  </div>
  <div class="container">
    <ul>
      <li v-for="i in 10" class="h-[180px] mb-[10px] shadow rounded bg-white flex items-center px-[10px]" @click.prevent="openArticle(i)">
        <div>
          <div class="w-[150px] h-[150px] bg-red-900">
          </div>
        </div>
        <div class="px-[20px]">
          <h2 class="mb-[20px] font-semibold">Heading</h2>
          <p class="text-sm">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquid beatae consequuntur ducimus eius fuga, fugiat harum itaque labore minus quae quam reiciendis sequi, sit sunt vero vitae voluptatem voluptates!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea error nam quaerat sapiente temporibus tenetur. Aspernatur distinctio eligendi et rerum sapiente! Corporis eum quam, qui repellat sapiente veniam vero! Earum?
          </p>
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped lang="scss">
li:hover{
  transition: all ease-in 100ms;
  transform: scale(1.02);
  cursor: pointer;
}
</style>