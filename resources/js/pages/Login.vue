<template>

  <div class="container--small">
    <!-- 切り替えタブ -->
    <ul class="tab">
      <li class="tab__item" v-on:click="tab = 1" v-bind:class="{'tab__item--active': tab === 1}">ログイン！</li>
      <li class="tab__item" v-on:click="tab = 2" v-bind:class="{'tab__item--active': tab === 2}">新規登録！</li>
    </ul>

    <!-- ログイン入力フォーム -->
    <div class="panel" v-show="tab === 1">
      <form class="form" v-on:submit.prevent="login">

        <label for="login-email">メールアドレス</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
        <label for="login-password">パスワード</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
        <div class="form__button">
          <button class="button button--inverse">ログインする</button>
        </div>

      </form>
    </div>

    <!-- 新規登録入力フォーム -->
    <div class="panel" v-show="tab === 2">
      <form class="form" v-on:submit.prevent="register">

        <label for="username">ユーザーネーム</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name">
        <label for="email">メールアドレス</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email">
        <label for="password">パスワード</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password">
        <label for="password-confirmation">パスワードの再入力</label>
        <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
        <div class="form__button">
          <button type="submit" class="button button--inverse">新規登録</button>
        </div>

      </form>

    </div>
  </div>


</template>


<script>
export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        username: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    login() {
      alert('loginメソッドです！');
      this.$router.push('/');
    },
    register() {
      alert('registerメソッドです！')
      this.$router.push('/');

    }
  }
}

</script>