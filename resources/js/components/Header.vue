<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/"></RouterLink>
    <div class="navbar__menu">
      <RouterLink class="btn btn--link" to="/mypage" v-if="username">{{ username }}</RouterLink>
      <div class="navbar__item" v-else>
        <RouterLink class="btn btn--link" to="/login">ログイン/新規登録</RouterLink>
      </div>

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