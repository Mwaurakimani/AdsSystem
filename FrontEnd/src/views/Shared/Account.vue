<script setup>
import DashboardHeading from '@/components/DashboardComponents/DashboardHeading.vue'
import MarketerLayout from '@/components/Layouts/MarketerLayout.vue'
import CreatorLayout from "@/components/Layouts/CreatorLayout.vue";
import {useRouter} from "vue-router";
import {computed, onBeforeMount, ref, shallowRef} from "vue";

const router = useRouter();
const component = shallowRef({
  component: MarketerLayout
})


onBeforeMount(async () => {
  let userStorage = await getUserFromLocalStorage()
  let user = JSON.parse(userStorage)

  console.log(user)

  if (user && user.accountType === 'marketer') {
    component.value = {
      component: MarketerLayout
    }
  } else if (user && user.accountType === 'creator') {
    component.value = {
      component: CreatorLayout
    }
  }
})

async function getUserFromLocalStorage() {
  return localStorage.getItem('user');
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
              <input type="text">
            </div>
            <div>
              <label>Email</label>
              <input type="email">
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
            <p>Marketer</p>
          </div>

          <div>
            <button>Save</button>
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
  @apply px-[10px] !rounded;
}

label {
  color: grey;
  margin-bottom: 10px;

}
</style>