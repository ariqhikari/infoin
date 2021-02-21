import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [{
    path: '/',
    name: 'Home',
    component: () => import( /* webpackChunkName: "Home" */ '../views/Home.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/about',
    name: 'About',
    component: () => import( /* webpackChunkName: "About" */ '../views/About.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/guide-life',
    name: 'GuideLife',
    component: () => import( /* webpackChunkName: "GuideLife" */ '../views/GuideLife.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/category/:slug',
    name: 'Category',
    component: () => import( /* webpackChunkName: "Category" */ '../views/Category.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/article',
    name: 'Article',
    component: () => import( /* webpackChunkName: "Article" */ '../views/Article.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/article/:slug',
    name: 'ArticleDetail',
    component: () => import( /* webpackChunkName: "ArticleDetail" */ '../views/ArticleDetail.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/profile/:slug',
    name: 'Profile',
    component: () => import( /* webpackChunkName: "Profile" */ '../views/Profile.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/donation',
    name: 'Donation',
    component: () => import( /* webpackChunkName: "Donation" */ '../views/Donation.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/donation/:slug',
    name: 'DonationDetail',
    component: () => import( /* webpackChunkName: "DonationDetail" */ '../views/DonationDetail.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/checkout/:slug',
    name: 'Checkout',
    component: () => import( /* webpackChunkName: "Checkout" */ '../views/Checkout.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/event',
    name: 'Event',
    component: () => import( /* webpackChunkName: "Event" */ '../views/Event.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/event/:slug',
    name: 'EventDetail',
    component: () => import( /* webpackChunkName: "EventDetail" */ '../views/EventDetail.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/blacklist',
    name: 'Blacklist',
    component: () => import( /* webpackChunkName: "Blacklist" */ '../views/Blacklist.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/authorize/google/callback',
    name: 'LoginGoogle',
    component: () => import( /* webpackChunkName: "LoginGoogle" */ '../views/LoginGoogle.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import( /* webpackChunkName: "Login" */ '../views/Login.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import( /* webpackChunkName: "Register" */ '../views/Register.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/verify-email',
    name: 'VerifyEmail',
    component: () => import( /* webpackChunkName: "VerifyEmail" */ '../views/VerifyEmail.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/confirm-email/:token',
    name: 'ConfirmEmail',
    component: () => import( /* webpackChunkName: "ConfirmEmail" */ '../views/ConfirmEmail.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: () => import( /* webpackChunkName: "ForgotPassword" */ '../views/ForgotPassword.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
  {
    path: '/reset-password/:token',
    name: 'ResetPassword',
    component: () => import( /* webpackChunkName: "ResetPassword" */ '../views/ResetPassword.vue'),
    meta: {
      transition: 'overlay-right'
    },
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router