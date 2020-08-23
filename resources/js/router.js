import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントのインポート
import Login from './pages/Login'
import ReportList from "./pages/ReportList"
import Mypage from './pages/Mypage.vue'
import ReportNew from './pages/reports/New.vue'
import ReportDetail from './pages/reports/ReportDetail.vue'
import SystemError from './pages/errors/System500.vue'

// ストアのインポート
import store from './store'

// Vue Routerプラグインの使用
Vue.use(VueRouter)


// パスとコンポーネントをマッピングする
const routes = [
  {
    path: '/',
    component: ReportList
  },
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
    path: '/mypage',
    component: Mypage,
    beforeEnter(to, from, next) {
      // ログイン画面はログインしていない場合ログインページにリダイレクト
      if (store.getters['auth/loginCheck']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/reports/new',
    component: ReportNew,
    beforeEnter(to, from, next) {
      // ログイン画面はログインしていない場合ログインページにリダイレクト
      if (store.getters['auth/loginCheck']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/reports/:id',
    component: ReportDetail,
    props: true,
    beforeEnter(to, from, next) {
      // ログイン画面はログインしていない場合ログインページにリダイレクト
      if (store.getters['auth/loginCheck']) {
        next()
      } else {
        next('/login')
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