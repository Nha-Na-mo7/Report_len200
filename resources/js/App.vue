<template>
  <div class="allWrapper">
    <!-- ヘッダ ー-->
    <header>
      <Header />
    </header>

    <!-- メインエリア -->
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>

    <!-- フッター -->
    <Footer />

  </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import {NOT_FOUND, UNAUTHORIZED ,INTERNAL_SERVER_ERROR} from "./util";

export default {
  components: {
    Header,
    Footer
  },
  computed: {
    errorCode() {
      return this.$store.state.error.errorCode
    }
  },
  watch: {
    errorCode: {
      async handler(val) {
        if(val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')

        }else if(val === UNAUTHORIZED) {
          // トークンをリフレッシュ
          await axios.get('/api/reflesh-token');
          // ストアのuserをクリアする
          this.$store.commit('auth/setUser', null);
          // ログイン画面へ遷移させる
          this.$router.push('/login');

        }else if(val === NOT_FOUND) {
          this.$router.push('/404');
        }
      },
      immediate: true
    },
    $route() {
      this.$store.commit('error/setErrorCode', null)
    }
  }
}

</script>