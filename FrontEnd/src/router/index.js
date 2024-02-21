import { createRouter, createWebHistory } from 'vue-router'
import home from '@/views/signin.vue'
import register from '@/views/register.vue'
import { marketerRoutes } from '@/router/marketer/routes.js'
import { creatorRoutes } from '@/router/creator/routes.js'
import Account from "@/views/Shared/Account.vue";
import {is_Authenticated} from "@/composables/Authentication.js";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
    {
      path: '/register',
      name: 'register',
      component: register
    },
    {
      path: '/account',
      name: 'account',
      component: Account,
      meta:{requiresAuth:true}
    },
    ...marketerRoutes,
    ...creatorRoutes
  ]
})


router.beforeEach(async (to, from, next) => {

  const authenticated = await is_Authenticated(true);

  if (to.meta.requiresAuth && !authenticated) {
    next({ name: 'home' });
  } else if ((to.name === 'home' || to.name === 'register') && authenticated){
    next({ name: 'account' });
  } else {
    next();
  }

});

router.beforeEach(async (to, from, next) => {
  const authenticated = await is_Authenticated();
  const user = JSON.parse(localStorage.getItem('user'));

  if (to.meta.marketerGuard && user.accountType !== 'marketer') {
    next({ name: 'home' });
  }  else if (to.meta.creatorGuard &&  user.accountType !== 'creator') {
    next({ name: 'home' });
  } else if (to.meta.adminGuard &&  user.accountType !== 'admin') {
    next({ name: 'home' });
  }

  next();
});

export default router
