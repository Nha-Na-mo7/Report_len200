<template>
  <div class="container--small">
    <!--プロフィールの編集-->
    <div v-if="this.isExistProfile" class="report-form">
      <h2 class="title u__mb-3l">プロフィール編集</h2>

      <!-- エラーメッセージ -->


      <!-- フォーム -->
      <form class="form" v-on:submit.prevent="edit_submit">
        <label for="edit_profile">プロフィール <span>( 入力文字数 : {{ edit_content_length }} / 500文字 )</span></label>
        <textarea class="form__item form__textarea" id="edit_profile" placeholder="500字以内で入力してください。" v-model="profileEditForm.profile"></textarea>


        <div class="form__btn">
          <button type="submit" class="btn btn--inverse">更新する</button>
        </div>
      </form>

    </div>

    <!--プロフィールの新規登録-->
    <div v-else class="report-form">
      <h2 class="title u__mb-3l">プロフィールを追加する</h2>

      <!-- エラーメッセージ -->


      <!-- フォーム -->
      <form class="form" v-on:submit.prevent="add_submit">
        <label for="edit_profile">プロフィール <span>( 入力文字数 : {{ add_content_length }} / 500文字 )</span></label>
        <textarea class="form__item form__textarea" id="add_profile" placeholder="500字以内で入力してください。" v-model="profileAddForm.profile"></textarea>


        <div class="form__btn">
          <button type="submit" class="btn btn--inverse">プロフィールを追加する</button>
        </div>
      </form>

    </div>

    <!--    トップへ戻る-->
    <RouterLink class="btn" to="/">日誌一覧へ戻る</RouterLink>

  </div>

</template>

<script>
import {CREATED, OK, NOT_FOUND, UNPROCESSABLE_ENTITY} from '../../util.js'

export default {
  data() {
    return {
      isExistProfile: false,
      profileEditForm: {
        profile: ''
      },
      profileAddForm: {
        profile: ''
      },
      errors: null
    }
  },
  computed: {
    add_content_length() {
      return this.profileAddForm.profile.length;
    },
    edit_content_length() {
      return this.profileEditForm.profile.length;
    },
    loginUserId () {
      return this.$store.getters['auth/user_id']
    }
  },
  methods: {
    // ===============
    // プロフィール更新
    // ===============
    async edit_submit () {
      const response = await axios.put(`../api/profile/${this.loginUserId}`, this.profileEditForm);
      // バリデーションエラー
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.errors = response.data.errors;
        return false
      }

      // 更新完了
      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }

      // 投稿後にマイページへ遷移させる
      this.$router.push(`/mypage/${this.loginUserId}`)
    },
    // ===============
    // プロフィール作成
    // ===============
    async add_submit () {
      const response = await axios.post('../api/profile', this.profileAddForm);

      // バリデーションエラー
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.errors = response.data.errors;
        return false
      }

      // 作成完了
      if (response.status !== CREATED) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }

      // 投稿後にマイページへ遷移させる
      this.$router.push(`/mypage/${this.loginUserId}`)
    },
    // ===============
    // プロフィールの取得
    // ===============
    async fetchProfile() {
      const response = await axios.get(`../api/profile/${this.loginUserId}`)

      if (response.status !== NOT_FOUND) {
        if (response.status !== OK) {
          this.$store.commit('error/setErrorCode', response.status)
          return false
        }
        this.isExistProfile = true
        this.profileEditForm.profile = response.data.profile;
      }else{
        this.isExistProfile = false
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchProfile()
      },
      immediate: true
    }
  }

}
</script>


