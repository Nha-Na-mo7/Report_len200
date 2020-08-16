import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントのインポート
import Login from './pages/Login'
import SystemError from './pages/errors/System500.vue'

// ストアのインポート
import store from './store'

// Vue Routerプラグインの使用
Vue.use(VueRouter)


// パスとコンポーネントをマッピングする
const routes = [
  {
    path: '/login',
    component: Login,
    beforeEnter(to, from, next) {
      // ログイン画面はログイン済みの場合トップページにリダイレクト
      if (store.getters['auth/loginCheck']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスの作成
const router = new VueRouter({
  mode: 'history',
  routes
});

// VueRouterインスタンスのエクスポート
export default router;