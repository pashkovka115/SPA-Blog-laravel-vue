import {createRouter, createWebHistory} from 'vue-router'
import GlobalFeed from '@/views/GlobalFeed'
import Register from '@/views/Register'
import Login from '@/views/Login'
import YourFeed from '@/views/YourFeed'
import TagFeed from '@/views/TagFeed'
import Article from '@/views/Article'
import CreateArticle from '@/views/CreateArticle'
import EditArticle from '@/views/EditArticle'
import Settings from '@/views/Settings'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
  },
  {
    path: '/',
    name: 'global_feed',
    component: GlobalFeed,
  },
  {
    path: '/feed',
    name: 'your_feed',
    component: YourFeed,
  },
  {
    path: '/tags/:slug',
    name: 'tag',
    component: TagFeed,
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/About.vue'),
  },
  {
    path: '/articles/create/article',
    name: 'create_article',
    component: CreateArticle,
  },
  {
    path: '/articles/:slug',
    name: 'article',
    component: Article,
  },
  {
    path: '/articles/:slug/edit/article',
    name: 'edit_article',
    component: EditArticle,
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings,
  },
  {
    path: '/profiles/:slug',
    name: 'user_profile',
    component: Register, ///////////////////////////////////
  },
  {
    path: '/profiles/:slug/favorites',
    name: 'user_profile_favorites',
    component: Register, ///////////////////////////////////
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not_found',
    component: () => import('@/views/404'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
