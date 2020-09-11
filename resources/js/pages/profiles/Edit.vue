<template>
  <div class="container--small">
    <!--プロフィールの新規登録-->
    <div class="">
      <div class="report-form">
        <h2 class="title u__mb-3l">プロフィールを追加する</h2>

        <!-- エラーメッセージ -->


        <!-- フォーム -->
        <form class="form" v-on:submit.prevent="add_submit">
<!--          <label for="edit_username">ユーザーネーム <span>( {{ add_username_length }} / 20文字 )</span></label>-->
<!--          <input type="text" class="form__item" id="add_username" placeholder="名前を入力しましょう" autocomplete="off" v-model="profileAddForm.username">-->
          <label for="edit_profile">プロフィール <span>( 入力文字数 : {{ add_content_length }} / 500文字 )</span></label>
          <textarea class="form__item form__textarea" id="add_profile" placeholder="500字以内で入力してください。" v-model="profileAddForm.prof_content"></textarea>


          <div class="form__btn">
            <button type="submit" class="btn btn--inverse">プロフィールを追加する</button>
          </div>
        </form>

      </div>

    </div>

    <!--プロフィールの編集-->
    <div class="">
      <div class="report-form">
        <h2 class="title u__mb-3l">プロフィール編集</h2>

        <!-- エラーメッセージ -->


        <!-- フォーム -->
        <form class="form" v-on:submit.prevent="">
<!--          <label for="edit_username">ユーザーネーム <span>( {{ edit_username_length }} / 20文字 )</span></label>-->
<!--          <input type="text" class="form__item" id="edit_username" placeholder="名前を入力しましょう" autocomplete="off" v-model="profileEditForm.username">-->
          <label for="edit_profile">プロフィール <span>( 入力文字数 : {{ edit_content_length }} / 500文字 )</span></label>
          <textarea class="form__item form__textarea" id="edit_profile" placeholder="500字以内で入力してください。" v-model="profileEditForm.prof_content"></textarea>


          <div class="form__btn">
            <button type="submit" class="btn btn--inverse">更新する</button>
          </div>
        </form>

      </div>

    </div>


    <!--    トップへ戻る-->
    <RouterLink class="btn" to="/">日誌一覧へ戻る</RouterLink>

  </div>

</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../../util.js'

export default {
  data() {
    return {
      profileAddForm: {
        username: '',
        prof_content: ''
      },
      profileEditForm: {
        username: '',
        prof_content: ''
      },
      errors: null
    }
  },
  computed: {
    add_username_length() {
      return this.profileAddForm.username.length;
    },
    edit_username_length() {
      return this.profileEditForm.username.length;
    },
    add_content_length() {
      return this.profileAddForm.prof_content.length;
    },
    edit_content_length() {
      return this.profileEditForm.prof_content.length;
    },
    loginUserId () {
      return this.$store.getters['auth/user_id']
    }
  },
  methods: {
    async add_submit () {
      // const response = await axios.post('../api/profile', this.profileAddForm);
      //
      // // バリデーションエラー
      // if (response.status === UNPROCESSABLE_ENTITY) {
      //   console.log('Edit.vue add_submit() : 422エラーです！')
      //   this.errors = response.data.errors;
      //   return false
      // }
      //
      // // 作成完了
      // if (response.status !== CREATED) {
      //   this.$store.commit('error/setErrorCode', response.status)
      //   return false
      // }

      // 投稿後にマイページへ遷移させる
      this.$router.push(`/mypage/${this.loginUserId}`)
    }
  }

}
</script>


