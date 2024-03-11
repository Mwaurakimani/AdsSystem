<script setup>
import {ref} from "vue";

const user = ref(JSON.parse(localStorage.getItem('user')))
</script>

<template>
  <div class="view-holder">
    <div class="side-section">
      <div class="w-[100%] h-[50px] mb-[30px] px-[20px] flex items-center">
        <h4 class="text-blue-400 font-semibold text-[1.3em]">Welcome, {{user.username}}</h4>
      </div>
      <div class="w-[100%] h-[300px]">
        <ul class="navigation-pane">
          <li><router-link class="navigation-pane-button active" to="/marketer/dashboard">Dashboard</router-link></li>
          <li><router-link class="navigation-pane-button" to="/marketer/campaigns">Campaigns</router-link></li>
          <li><router-link class="navigation-pane-button" to="/marketer/campaigns">Billings</router-link></li>
          <li><router-link class="navigation-pane-button" to="/account">Account</router-link></li>
        </ul>
      </div>
    </div>
    <div class="main-section">
      <slot></slot>
    </div>
  </div>
</template>

<style scoped>
.view-holder {
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: space-between;
}

.side-section{
  width: 250px;
  height: 100%;
  overflow: auto;
  @apply shadow-lg shadow-[grey] bg-white;

  .navigation-pane{
    @apply px-[5px];

    .navigation-pane-button{
      text-decoration: none !important;
      @apply bg-gray-200 w-[100%] block mb-[10px] py-[6px] px-[10px] rounded-lg text-gray-600 transition duration-200;

      &:hover{
        @apply bg-blue-300 text-white;
      }
    }

    .active{
      @apply bg-blue-500 text-white
    }
  }
}

.main-section{
  width: calc(100% - 255px);
  height: 100%;
  overflow: auto;
  @apply px-[10px] bg-gray-100;
}
</style>