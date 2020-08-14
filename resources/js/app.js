import './bootstrap.js';
import Vue from "vue";
// ルーティングの定義
import router from "./router.js";
// (ルート)ストア
import store from "./store/index.js"
// ルートコンポーネント
import App from "./App.vue"


new Vue({
    el: '#app',
    router, //ルーティングの定義読み込み
    store, // Vuexストアの読み込み
    components: { App }, // ルートコンポーネント
    template: '<App />' // ルートコンポーネントの描画
});
