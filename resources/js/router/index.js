import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../views/Dashboard.vue'
import Post from '../views/Post/Post.vue'
Vue.use(VueRouter)
 
  const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/posts',
    name: 'Posts',
    component: Post
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
