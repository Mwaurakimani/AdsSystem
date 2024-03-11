<script setup>
import {inject, onMounted, ref, watchEffect} from 'vue'
import {useServer} from "@/composables/server.js";

const props = defineProps(['page'])

const server = useServer()
const adSpace = ref({
  id: '',
  type: 'banner',
  page_id: ''
})

const activeAdSpace = inject('activeAdSpace')
const page = inject('page')

const script = ref('')

const loadAdSpace = () => {
  adSpace.value = {
    id: '',
    type: '',
    page_id: ''
  }

  if (activeAdSpace.value != null) {
    server.get('/api/adSpace/getGenerate/' + activeAdSpace.value)
        .then((resp) => {
          adSpace.value = {
            id: resp.data.id,
            type: resp.data.type,
            status: resp.data.status,
            page_id: resp.data.page_id
          }
          script.value = '<div class="ad-space" data-placement-id="' + adSpace.value.id + '" ></div>'
        })
        .catch((err) => {
          console.log(err.data)
        })
  }
}

function copyCode() {
  navigator.clipboard
      .writeText(script.value)
      .then(() => {
        alert('copied')
      })
      .catch((err) => {
        console.log(err)
      })
}

function generate() {
  adSpace.value.page_id = page.value.id

  server.post('/api/adSpace/generate', adSpace.value)
      .then((resp) => {
        adSpace.value = resp.data.adSpace
        script.value = '<div class="ad-space" data-placement-id="' + adSpace.value.id + '" ></div>'
      })
      .catch((err) => {
        console.log(err.data.message)
      })
}

function resetScript(){
  script.value = ''
  adSpace.value = {
    id: '',
    type: '',
    page_id: ''
  }

}
watchEffect(loadAdSpace)
defineExpose({resetScript})

</script>

<template>
  <div class="w-[550px] text-sm pt-[20px]">
    <div v-if="activeAdSpace" class="px-[30px] mb-[10px] flex">
      <label>ID</label>
      <p>{{ activeAdSpace }}</p>
    </div>
    <div class="px-[30px] mb-[10px]">
      <label>Type</label>
      <select class="border px-[10px] py-[3px]" v-model="adSpace.type">
        <option value="banner">Banner</option>
        <option value="side_bar">Side Bar</option>
        <option value="in_content">In Content</option>
      </select>
    </div>
    <div class="px-[30px] mb-[30px]">
      <label>Status</label>
      <select>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>
    <div class="px-[30px]">
      <div class="flex justify-between mb-[10px]">
        <p v-if="script !==''">Code</p>
        <div v-else>
          <button @click.prevent="generate">Generate</button>
        </div>
      </div>
      <div v-if="script !== '' && adSpace.id !== ''" class="bg-gray-600 p-[10px] text-white rounded flex">
        <div class="w-[100%]">
          {{ script }}
        </div>
        <div
            class="w-1/12 hover:bg-gray-500 flex items-center justify-center rounded cursor-copy"
            @click.prevent="copyCode"
        >
          copy
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
input,
select {
  @apply border h-[30px] px-[10px] w-[350px];
}

label {
  width: 80px;
}
</style>
