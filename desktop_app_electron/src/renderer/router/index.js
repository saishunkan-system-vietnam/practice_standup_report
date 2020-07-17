import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
const LoginTemp = { template: '<div>template login</div>' }
const DailyTemp = { template: '<div>template Daily report</div>' }
export default new Router({
  routes: [
    {
      path: '/',
      name: 'landing-page',
      component: require('@/components/MainPage').default
    },
    {
      path: '/login',
      name: 'Login',
      component: require('@/components/LoginComponent').default
    },
    {
      path: '/daily-report',
      name: 'DailyReport',
      component: require('@/components/Employee/DailyReport').default
    },
    {
      path: '/manage-job',
      name: 'ManageJob',
      component: require('@/components/Manage/ManageJob').default
    },
    {
      path: '/detail-job',
      name: 'DetailJob',
      component: require('@/components/Manage/DetailJob').default
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})
