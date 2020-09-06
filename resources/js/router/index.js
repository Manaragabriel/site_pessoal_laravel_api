import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../views/Dashboard.vue'
import Post from '../views/Post/Post.vue'
import CreatePost from '../views/Post/CreatePost.vue'
import EditPost from '../views/Post/EditPost.vue'
import Category from '../views/Category/Category.vue'
import CreateCategory from '../views/Category/CreateCategory.vue'
import EditCategory from '../views/Category/EditCategory.vue'
import Login from '../views/Login/Login.vue'




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
  },
  {
    path: '/posts/criar',
    name: 'Criar posts',
    component: CreatePost
  },
  {
    path: '/posts/editar/:id',
    name: 'Editar posts',
    component: EditPost
  },
  {
    path: '/categorias',
    name: 'Categorias',
    component: Category
  },
  {
    path: '/categorias/criar',
    name: 'Criar categorias',
    component: CreateCategory
  },
  {
    path: '/categorias/editar/:id',
    name: 'Editar categorias',
    component: EditCategory
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})


export default router
