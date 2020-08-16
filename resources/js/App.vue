<template>
  <div>
    <!-- ヘッダ ー-->
    <header>
      <Header />
    </header>

    <!-- メイン -->
    <main>
      <h1>App.Vueエリア</h1>
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
import {INTERNAL_SERVER_ERROR} from "./util";

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
      handler: function(val) {
        if(val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')
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