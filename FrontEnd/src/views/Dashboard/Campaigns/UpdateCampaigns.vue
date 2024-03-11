<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import {onBeforeMount, provide, reactive, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useServer} from "@/composables/server.js";
import {useSetupStore} from "@/stores/setupStore.js";
import {errorsValues, formatErrors} from "@/composables/serverFromatter.js";
import EditTags from "@/views/Dashboard/Campaigns/EditTags.vue";

const router = useRouter()
const route = useRoute()
const server = useServer()
const useSetup = useSetupStore()

const campaign = reactive({})
const loading = ref(true)

onBeforeMount(() => {
  server.get('/api/campaign/view/' + route.params.id)
      .then((resp) => {

        Object.keys(resp.data).forEach(key => {
          campaign[key] = resp.data[key];
        });

        campaign.display_on = JSON.parse(resp.data.display_on)

        if (!Array.isArray(campaign.display_on)) {
          campaign.display_on = []
        }

        campaign.tags = JSON.parse(resp.data.tags)

        if (!Array.isArray(campaign.tags)) {
          campaign.tags = []
        }

        loading.value = false

      })
      .catch((err) => {

        console.log(err.data)

        loading.value = false

      })
})

const submitForm = () => {
  const formData = new FormData();

  for (const key in campaign) {

    if (campaign[key] === null || campaign[key] === undefined) continue;

    if (Array.isArray(campaign[key])) {

      campaign[key].forEach((value, index) => {
        formData.append(`${key}[${index}]`, value);
      });

    } else {
      formData.append(key, campaign[key]);
    }
  }

  server
      .post('/api/campaign/update/' + campaign.id, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((resp) => {
        window.location.href = window.location.href
      })
      .catch((error) => {
        formatErrors(error)
      });
}


const addTag = (tag) => {
  tag = tag.trim()
  if(tag != '' || tag != null){
    campaign.tags = [... campaign.tags,tag]
  }
}

const removeTagParent = (remove) => {
  campaign.tags = campaign.tags.filter(tag => tag !== remove);
};

provide('removeTagParent',removeTagParent)
provide('addTag',addTag)

</script>

<template>
  <marketer-layout>
    <DashboardHeading :page-title="'Campaigns'"></DashboardHeading>

    <div class="action-bar py-[10px] px-[10px] flex justify-between">
      <div>
        <ul class="flex space-x-2">
          <li>
            <button class="text-sm" @click.prevent="createCampaign">Create New</button>
          </li>
          <li>
            <button class="text-sm">View Active</button>
          </li>
          <li>
            <button class="text-sm">View Inactive</button>
          </li>
        </ul>
      </div>
    </div>

    <div v-if="loading" class="p-[20px] flex items-center justify-center">
      <div class="spinner"></div>
    </div>


    <div v-else class="w-[100%] flex space-x-2 text-sm">

      <div class="w-2/3 h-[300px]">

        <div class="p-[20px] mb-[30px] bg-white shadow-md">

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Title</label>
            <div class="w-4/6">
              <input type="text" class="border px-[5px]" v-model="campaign.title"/>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Campaign Type</label>
            <div class="w-4/6">
              <input type="radio" id="option1" value="image" class="mr-[10px]"
                     v-model="campaign.campaign_type">Image<br>
              <input type="radio" id="option2" value="video" class="mr-[10px]"
                     v-model="campaign.campaign_type">Video<br>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Upload File</label>
            <div class="w-4/6 flex space-x-2">
              <div>
                <input type="file" @change="(event) => campaign.upload = event.target.files[0]">
              </div>
              <div>
                <div class="w-[300px] h-[200px]">
                  <img class="w-[100%] flex max-h-[100%]"
                       :src="useSetup.host+'/storage/'+campaign.upload.replace(/^public\//, '')" alt="ad">
                </div>
              </div>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Upload File</label>
            <div class="w-4/6">
              <select class="border px-[10px] py-[3px]" v-model="campaign.display_type">
                <option value="banner">Banner</option>
                <option value="side_bar">Side Bar</option>
                <option value="in_content">In Content</option>
              </select>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Redirect Link</label>
            <div class="w-4/6">
              <input type="text" class="border" v-model="campaign.redirect_link"/>
            </div>
          </div>

        </div>

        <div class="p-[20px] mb-[30px] bg-white shadow-md">

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">Display On</label>
            <div class="w-4/6">
              <input type="checkbox" id="option1" value="Sunday" class="mr-[10px]"
                     v-model="campaign.display_on">Sunday<br>
              <input type="checkbox" id="option2" value="Monday" class="mr-[10px]"
                     v-model="campaign.display_on">Monday<br>
              <input type="checkbox" id="option3" value="Tuesday" class="mr-[10px]" v-model="campaign.display_on">Tuesday<br>
              <input type="checkbox" id="option4" value="Wednesday" class="mr-[10px]" v-model="campaign.display_on">Wednesday<br>
              <input type="checkbox" id="option5" value="Thursday" class="mr-[10px]" v-model="campaign.display_on">Thursday<br>
              <input type="checkbox" id="option6" value="Friday" class="mr-[10px]"
                     v-model="campaign.display_on">Friday<br>
              <input type="checkbox" id="option7" value="Saturday" class="mr-[10px]" v-model="campaign.display_on">Saturday<br>
              <p v-if="errorsValues.display_on" class="text-red-400 py-[10px] text-sm">
                {{ errorsValues?.display_on[0] }}</p>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[10px]">
            <label class="w-2/6">From</label>
            <div class="w-3/6">
              <div class=" flex mb-[10px]">
                <input type="time" class="border px-[5px]" v-model="campaign.from_start">
                <p class="mx-[10px]">to</p>
                <input type="time" class="border px-[5px]" v-model="campaign.from_end">
              </div>
              <div>
                <p v-if="errorsValues.from_start" class="text-red-400 py-[5px] text-sm">
                  {{ errorsValues?.from_start[0] }}</p>
                <p v-if="errorsValues.from_end" class="text-red-400 py-[5px] text-sm">
                  {{ errorsValues?.from_end[0] }}</p>
              </div>
            </div>
          </div>

          <div class="flex w-[100%] space-x-2 mb-[15px]">
            <label class="w-2/6">Billing Limit</label>
            <div class="w-4/6">
              <input type="number" class="border px-[5px]" v-model="campaign.billing_limit"/>
            </div>
          </div>

          <div class="flex">
            <div class="w-2/6">
            </div>
            <div>
              <p class="mb-[10px]">What to do when billing limit is reached</p>
              <div class="text-gray-500">
                <input type="radio" id="option1" value="Deactivate" class="mr-[10px]"
                       v-model="campaign.billing_limit_action">Deactivate and notify<br>
                <input type="radio" id="option2" value="Notify" class="mr-[10px]"
                       v-model="campaign.billing_limit_action">Just Notify<br>
              </div>
            </div>

          </div>

        </div>

      </div>

      <div class="w-1/3 h-[300px]">

        <div class="bg-white shadow-md mb-[10px] p-[10px]">
          <button class="text-sm w-[100%] mb-[10px]" @click.prevent="submitForm">Update</button>
          <button class="text-sm w-[100%] bg-orange-400 mb-[10px]"
                  @click.prevent="router.push({name:'viewCampaign' , pram:{id:campaign.id}})">View Campaign
          </button>
          <button class="text-sm w-[100%] bg-red-400">Delete</button>
        </div>

        <div class="bg-white shadow-md p-[10px] mb-[20px]">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Stats</h3>
          </div>
          <ul class="p-[10px]">
            <li class="flex items-center">
              <label class="w-[110px]">Status</label>
              <select class="border w-[100%] p-[5px] rounded" v-model="campaign.status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </li>
          </ul>
        </div>

        <EditTags :tags="campaign.tags"/>

      </div>

    </div>

  </marketer-layout>
</template>

<style scoped>
input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}
</style>