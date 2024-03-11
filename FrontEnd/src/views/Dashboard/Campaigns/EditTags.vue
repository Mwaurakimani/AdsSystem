<script setup>
import AppPill from "@/components/AppComponents/AppPill.vue";
import {inject, ref} from "vue";

const props = defineProps(['tags'])

const removeTagParent = inject('removeTagParent')
const addTag = inject('addTag')
const tagInput = ref(null)

function includeTag(){
  let input = $(tagInput.value)
  let tag = input.val()

  addTag(tag)
}

</script>

<template>
  <div class="bg-white shadow-md p-[10px] ">
    <div class="flex space-x-2 justify-between mb-[5px]">
      <h3 class="font-semibold">Tags</h3>
    </div>

    <div class="h-[35px] mb-[10px]" style="z-index: 500">
      <div class="flex justify-between mb-[10px] h-[30px]">
        <input class="border w-[100%] mr-[20px] px-[10px]" ref="tagInput">
        <button class="text-sm" @click.prevent="includeTag">Add</button>
      </div>
      <div class="w-[100%] h-[0px] bg-red-400 [z-index:1000]" style="position: absolute">

      </div>
    </div>

    <div class="flex flex-wrap gap-[10px]">
      <app-pill v-for="tag in props.tags" :pill-name=tag :key="tag" @removeTag="removeTagParent"></app-pill>
    </div>
  </div>
</template>
<style scoped>
input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>