<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand btn" to="/">日誌投稿アプリ</RouterLink>
    <div class="navbar__menu">
      <!--リンク先が変わらない場合はtoでリンクを指定する-->
      <!--動的にリンク先が変わる場合、:toでリンクを指定する-->
      <RouterLink class="btn btn--link" to="/reports/new" v-if="isLogin">新規作成</RouterLink>
      <RouterLink class="btn btn--link" :to="`/mypage/${this.user_id}`" v-if="username">{{ username }}</RouterLink>
      <div class="navbar__item" v-else>
        <RouterLink class="btn btn--link" to="/login">ログイン/新規登録</RouterLink>
      </div>

<!--      ログアウトボタン-->
      <button class="btn btn--link" v-on:click="logout" v-if="isLogin">ログアウトする</button>

    </div>
  </nav>
</template>

<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/loginCheck']
    },
    username () {
      return this.$store.getters['auth/username']
    },
    user_id () {
      return this.$store.getters['auth/user_id']
    },
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout');

      if(this.apiStatus) {
        this.$router.push('/login');
      }
    }
  }
}
</script>