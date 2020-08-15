<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/"></RouterLink>
    <div class="navbar__menu">
      <span class="navbar__item" v-if="username">{{ username }}</span>
      <div class="navbar__item" v-else>
        <RouterLink class="button button--link" to="/login">ログイン/新規登録</RouterLink>
      </div>

      <button class="button button--link" v-on:click="logout" v-if="isLogin">ログアウトする</button>

    </div>
  </nav>
</template>

<script>
export default {
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout');
      this.$router.push('/login');
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/loginCheck']
    },
    username () {
      return this.$store.getters['auth/username']
    }
  }
}
</script>