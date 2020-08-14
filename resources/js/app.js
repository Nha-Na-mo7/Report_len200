import './bootstrap.js';

import Vue from "vue";
// ルーティングの定義
import router from "./router.js";
// (ルート)ストア
import store from "./store/index.js"
// ルートコンポーネント
import App from "./App.vue"



// 現在ログイン中のユーザー情報をストアのuserステートに入れるアクションを呼ぶまで
const createApp = async() => {
    await store.dispatch('auth/currentUser');
    
    new Vue({
        el: '#app',
        router, //ルーティングの定義読み込み
        store, // Vuexストアの読み込み
        components: { App }, // ルートコンポーネント
        template: '<App />' // ルートコンポーネントの描画
    });
}

createApp()