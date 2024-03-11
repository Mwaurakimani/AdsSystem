<script setup>
import {ref} from "vue";

const props = defineProps(['heading'])
const emit = defineEmits(['closingModal'])
const displayValue = ref('none')
const displayModal = ref(null)

function closeModal(){
  let element = $(displayModal.value)

  element.fadeOut('fast')

  emit('closingModal')
}

function openModel(){
  let element = $(displayModal.value)

  element.fadeIn('fast')
}



defineExpose({ openModel })
</script>


<template>
  <div class="w-[100vw] h-[100vh] fixed top-0 z-10 modal-display" ref="displayModal">
    <div class="w-[100vw] h-[100vh] flex items-center justify-center">
      <div class="min-w-[300px] pb-[20px] bg-white rounded">
        <section class="flex items-center justify-between px-[10px] py-[5px] border-b">
          <h3 class="font-semibold">{{props.heading}}</h3>
          <div class="bg-red-400 w-[20px] h-[20px] rounded-[50%] flex items-center cursor-pointer justify-center" title="close" @click.prevent="closeModal">
            <i class="bi bi-x-lg text-white text-[13px]"></i>
          </div>
        </section>
        <section>
          <slot></slot>
        </section>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-display{
  display:v-bind(displayValue);
  background-color: rgba(000,000,000,0.8);
  @apply shadow-md;
}

</style>