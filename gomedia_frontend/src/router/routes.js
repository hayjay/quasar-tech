
import { Store } from '../store/index.js';
const routes = [
  {
    path: '/dashboard',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: '/list/all', component: () => import('components/list/Index.vue') },
      { path: '/list/create', component: () => import('components/list/Add.vue') },
      { path: '/transaction-log/all', component: () => import('components/transactionLog/Index.vue') },
    ],
    // beforeEnter: (to, from, next) => {
    //     if(Store.state.auth.authenticated) {
    //        return next();

    //     }
    //     return next('/');
    // }
  },
  {
    path: '/',
    name: 'login',
    component: () => import('components/auth/Login.vue'),
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
