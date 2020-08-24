<template>
  <footer class="footer">
<!--    <button class="button button&#45;&#45;link"></button>-->
<!--    <RouterLink class="button button&#45;&#45;link" to="/login">-->
<!--      Footer - ログイン / 新規登録-->
<!--    </RouterLink>-->
    <div>
      <h3>現在時刻 : {{ nowtime }}</h3>
      <span>©️ Copyright 2020</span>
    </div>
  </footer>
</template>

<script>
export default {
  computed: {
    nowtime() {
      return new Date().toLocaleString();
    },
  }
}
</script>
