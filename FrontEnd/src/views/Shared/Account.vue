<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import CreatorLayout from "@/components/Layouts/CreatorLayout.vue";
import {useRouter} from "vue-router";
import {computed, onBeforeMount, ref, shallowRef} from "vue";
import {useServer} from "@/composables/server.js";

const router = useRouter();
const server = useServer()
const component = shallowRef({
  component: null
})

const Account = ref({
  username: null,
  email: null,
  accountType: null,
  status: 'Active'
})

onBeforeMount(async () => {
  let userStorage = await getUserFromLocalStorage()
  let user = JSON.parse(userStorage)

  Account.value.username = user.username
  Account.value.email = user.email
  Account.value.accountType = user.accountType

  if (user && user.accountType === 'marketer')
    component.value = {component: MarketerLayout}
  else if (user && user.accountType === 'creator')
    component.value = {component: CreatorLayout}

})

async function getUserFromLocalStorage() {
  return localStorage.getItem('user');
}

async function updateAccount() {
  try {
    let {data: {data}} = await server.post('/api/updateAccount', Account.value)
    alert("Updated Successfully")
  } catch ({response: {data: {message}}}) {
    alert(message)
  }
}

</script>


<template>
  <Component :is="component.component">
    <DashboardHeading :page-title="'Account'"></DashboardHeading>
    <div class="w-[100%] flex text-sm space-x-2">
      <div class="w-2/3 h-[300px]">
        <div class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[20px]">
            <h3 class="font-semibold">Update Account</h3>
          </div>

          <div class="flex justify-between mb-[20px]">
            <div>
              <label>Username</label>
              <input type="text" v-model="Account.username">
            </div>
            <div>
              <label>Email</label>
              <input type="email" v-model="Account.email">
            </div>
          </div>

          <div class="mb-[20px]">
            <div>
              <label class="block">Status</label>
              <select class="!w-[200px]">
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
          </div>

          <div class="flex space-x-[10px] mb-[20px]">
            <label>Account Type:</label>
            <p>{{ `${Account.accountType.charAt(0).toUpperCase()}${Account.accountType.slice(1)}` }}</p>
          </div>

          <div>
            <button @click.prevent="updateAccount">Save</button>
          </div>
        </div>

      </div>

      <div class="w-1/3 h-[300px]">
        <form class="p-[20px] mb-[30px] bg-white shadow-md">
          <div class="flex space-x-2 justify-between mb-[5px]">
            <h3 class="font-semibold">Update Password</h3>
          </div>

          <div class="mb-[20px]">
            <div class="mb-[20px]">
              <label>Username</label>
              <input type="password">
            </div>
            <div class="mb-[20px]">
              <label>Email</label>
              <input type="password">
            </div>
            <div class="mb-[20px]">
              <label>Email</label>
              <input type="password">
            </div>
          </div>

          <div>
            <button>Update</button>
          </div>
        </form>
      </div>

    </div>

  </Component>
</template>

<style scoped>
input[type='text'], input[type='email'], input[type='password'], select {
  width: 100%;
  height: 30px;
  border: 1px solid grey;
  @apply px-[10px] rounded !important;
}

input, select {
  @apply p-[6px] rounded-md outline-blue-400 !important;
}

label {
  color: grey;
  margin-bottom: 10px;

}
</style>