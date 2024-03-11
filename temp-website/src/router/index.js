import { createRouter, createWebHistory } from 'vue-router'
import home from "@/views/home.vue";
import about from "@/views/about.vue";
import blog from "@/views/blog.vue";
import Article from "@/views/Articles/Article.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
    {
      path: '/About',
      name: 'About',
      component: about
    },
    {
      path: '/Blog',
      name: 'Blog',
      component: blog
    },
    {
      path: '/Blog/article/:id',
      name: 'Article',
      component: Article
    },
  ]
})

export default router
