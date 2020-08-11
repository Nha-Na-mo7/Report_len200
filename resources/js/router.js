import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントのインポート
import Login from './pages/Login'

// Vue Routerプラグインの使用
Vue.use(VueRouter)


// パスとコンポーネントをマッピングする
const routes = [
  {
    path: '/login',
    component: Login
  }
]

// VueRouterインスタンスの作成
const router = new VueRouter({
  mode: 'history',
  routes
});

// VueRouterインスタンスのエクスポート
export default router;