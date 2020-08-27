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


        <div v-if="loginErrors" class="errors">
          <ul v-if="loginErrors.email">
            <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="loginErrors.password">
            <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>

        <label for="login-email">メールアドレス</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
        <label for="login-password">パスワード</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
        <div class="form__btn">
          <button class="btn btn--inverse">ログインする</button>
        </div>

      </form>
    </div>

    <!-- 新規登録入力フォーム -->
    <div class="panel" v-show="tab === 2">
      <form class="form" v-on:submit.prevent="register">

        <!-- エラーメッセージ -->
        <div v-if="registerErrors" class="errors">
          <ul v-if="registerErrors.name">
            <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.email">
            <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
          </ul>
          <ul v-if="registerErrors.password">
            <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
          </ul>
        </div>

        <label for="username">ユーザーネーム</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name" autocomplete="off">
        <label for="email">メールアドレス</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email" autocomplete="off">
        <label for="password">パスワード</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password">
        <label for="password-confirmation">パスワードの再入力</label>
        <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
        <div class="form__btn">
          <button type="submit" class="btn btn--inverse">新規登録</button>
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
  computed: {
    // import { mapState } from 'vuex' をすれば、下記のような書き方も可能
    // ...mapState({
    //   apiStatus: state => state.auth.apiStatus,
    //   loginErrors: state => state.auth.loginErrorMessages,
    //   registerErrors: state => state.auth.registerErrorMessages
    // })
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    loginErrors() {
      return this.$store.state.auth.loginErrorMessages;
    },
    registerErrors() {
      return this.$store.state.auth.registerErrorMessages;
    }
  },
  methods: {
    // authストアのloginアクションを使用、loginFormのデータを付与。
    async login() {
      await this.$store.dispatch('auth/login', this.loginForm);
      if (this.apiStatus) {
        this.$router.push('/');
      }
    },
    // authストアのregisterアクションを使用、registerFormのデータを付与。
    async register() {
      await this.$store.dispatch('auth/register', this.registerForm);
      if(this.apiStatus) {
        this.$router.push('/');
      }
    },
    // エラーメッセージのクリア(createdで呼び出す)
    clearError() {
      this.$store.commit('auth/setLoginErrorMessages', null);
      this.$store.commit('auth/setRegisterErrorMessages', null);
    }
  },
  created() {
    this.clearError();
  }
}

</script>