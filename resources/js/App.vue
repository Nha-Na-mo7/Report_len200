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

export default {
  components: {
    Header,
    Footer
  }
}

</script>