// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import VueRouter from './router'
Vue.config.productionTip = false

import Sophia from './components/sophia'  //引入根组件

// axios请求
import axios from 'axios'
Vue.prototype.$api = axios

// ui框架
import YDUI from 'vue-ydui'
import 'vue-ydui/dist/ydui.rem.css'
Vue.use(YDUI);

// vuex狂态管理
import store from './store'
// 下滑
// import BTscroll from 'better-scroll'

// 懒加载
// import VueLazyLoad from 'vue-lazyload'
// Vue.use(VueLazyLoad)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router : VueRouter,
  store,
  template: '<Sophia/>',
  components: { Sophia }
})
