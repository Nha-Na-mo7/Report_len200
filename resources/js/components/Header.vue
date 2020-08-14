<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/"></RouterLink>
    <div class="navbar__menu">
      <span class="navbar__item">[ header - username ]</span>
      <div class="navbar__item">
        <RouterLink class="button button--link" to="/login"> header - Login or Register</RouterLink>
      </div>
      <button class="button button--link" v-on:click="logout">ログアウトする</button>
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
  }
}
</script>
