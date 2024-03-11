<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import {useRouter} from "vue-router";
import {useServer} from "@/composables/server.js";
import {formatErrors, errorsValues} from "@/composables/serverFromatter.js";
import {ref} from "vue";
import SimpleFormDataBind from "@/composables/SimpleFormdataBind.js";

const router = useRouter()
const server = useServer()

const content = ref({
  title: "",
  campaignType: "",
  displayType: "",
  redirectLink: "",
  from_start: "",
  from_end: "",
  upload: "",
  displayOn: [],
})


function submitFrom() {

  let binder = ['title', 'campaignType', 'displayType', 'redirectLink', 'from_start', 'from_end']
  let formData = SimpleFormDataBind(binder, content.value)

  formData.append('upload', content.value.upload)
  formData.append('displayOn', JSON.stringify(content.value.displayOn))

  server.post('/api/campaign/create',
      formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((resp) => {
        alert(resp.data.message)
        router.push({name: 'MarketingCampaigns'})
      })
      .catch((error) => {
        formatErrors(error)
      });
}
</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>

    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="router.push({name:'MarketingCampaigns'})">View All Campaigns
            </button>
          </li>
        </ul>
      </div>
    </div>

    <form class="w-[100%] flex text-sm space-x-2">

      <div class="w-2/3 h-[300px]">

        <div class="p-[20px] mb-[30px] bg-white shadow-md">

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Title</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="content.title"/>
              <p v-if="errorsValues.title" class="text-red-400 text-right text-sm">{{ errorsValues?.title[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Campaign Type</label>
            <div class="w-4/6">
              <input type="radio" id="option1" value="image" class="mr-[10px]" v-model="content.campaignType">Image<br>
              <input type="radio" id="option2" value="video" class="mr-[10px]" v-model="content.campaignType">Video<br>
              <p v-if="errorsValues.campaignType" class="text-red-400 text-right text-sm">
                {{ errorsValues?.campaignType[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Upload File</label>
            <div class="w-4/6">
              <input type="file" @change="(event) => content.upload = event.target.files[0]">
              <p v-if="errorsValues.upload" class="text-red-400 text-right text-sm">{{ errorsValues?.upload[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Display Type</label>
            <div class="w-4/6">
              <select class="border px-[10px] py-[3px]" v-model="content.displayType">
                <option value="banner">Banner</option>
                <option value="side_bar">Side Bar</option>
                <option value="in_content">In Content</option>
              </select>
              <p v-if="errorsValues.displayType" class="text-red-400 text-right text-sm">
                {{ errorsValues?.displayType[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Redirect Link</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="content.redirectLink"/>
              <p v-if="errorsValues.redirectLink" class="text-red-400 text-right text-sm">
                {{ errorsValues?.redirectLink[0] }}</p>
            </div>
          </div>
        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">

          <h3 class="mb-[10px] text-[18px]">Advanced</h3>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Display On</label>
            <div class="w-4/6">
              <input type="checkbox" id="option1" value="Sunday" class="mr-[10px]"
                     v-model="content.displayOn">Sunday<br>
              <input type="checkbox" id="option2" value="Monday" class="mr-[10px]"
                     v-model="content.displayOn">Monday<br>
              <input type="checkbox" id="option3" value="Tuesday" class="mr-[10px]"
                     v-model="content.displayOn">Tuesday<br>
              <input type="checkbox" id="option4" value="Wednesday" class="mr-[10px]" v-model="content.displayOn">Wednesday<br>
              <input type="checkbox" id="option5" value="Thursday" class="mr-[10px]" v-model="content.displayOn">Thursday<br>
              <input type="checkbox" id="option6" value="Friday" class="mr-[10px]"
                     v-model="content.displayOn">Friday<br>
              <input type="checkbox" id="option7" value="Saturday" class="mr-[10px]" v-model="content.displayOn">Saturday<br>
              <p v-if="errorsValues.displayOn" class="text-red-400 py-[10px] text-sm">
                {{ errorsValues?.displayOn[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">From</label>
            <div class="w-3/6">
              <div class="flex mb-[10px]">
                <input type="time" class="border" v-model="content.from_start">
                <p class="mx-[10px]">to</p>
                <input type="time" class="border" v-model="content.from_end">
              </div>
              <div>
                <p v-if="errorsValues.from_start" class="text-red-400 py-[5px] text-sm">
                  {{ errorsValues?.from_start[0] }}</p>
                <p v-if="errorsValues.from_end" class="text-red-400 py-[5px] text-sm">
                  {{ errorsValues?.from_end[0] }}</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="w-1/3 h-[300px]">
        <div class="bg-white shadow-md p-[10px]">
          <button class="text-sm w-[100%]" @click.prevent="submitFrom">Save</button>
        </div>
      </div>

    </form>
  </marketer-layout>
</template>

<style scoped>
input {
  @apply px-[10px];
}

input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>