import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントのインポート
import Login from './pages/Login'
import ReportList from './pages/ReportList.vue'
import Mypage from './pages/Mypage.vue'
import ReportNew from './pages/reports/New.vue'
import ReportDetail from './pages/reports/ReportDetail.vue'
import SystemError from './pages/errors/System500.vue'
import NotFound from './pages/errors/NotFound404.vue'

// ストアのインポート
import store from './store'

// Vue Routerプラグインの使用
Vue.use(VueRouter)


// パスとコンポーネントをマッピングする
const routes = [
  {
    path: '/',
    component: ReportList,
    props: route => {
      const page = route.query.page
      return {
        // 整数でない値を1扱いにする
        page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1
      }
    }
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
    path: '/mypage/:user_id',
    component: Mypage,
    props: (route) => {
      const page = route.query.page
      return {
        // 整数でない値を1扱いにする
        page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1,
        // mypage/:user_id のuser_idの部分
        user_id: Number(route.params.user_id)
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
    path: '/reports/:report_id',
    component: ReportDetail,
    props: true
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '*',
    component: NotFound
  }
]

// VueRouterインスタンスの作成
const router = new VueRouter({
  mode: 'history',
  // ページ遷移時のスクロール位置
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes
});

// VueRouterインスタンスのエクスポート
export default router;