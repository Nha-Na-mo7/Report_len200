<template>
  <div class="container--small">
    <div class="report-form">
      <h2 class="title u__mb-3l">日誌 新規作成</h2>

      <!-- エラーメッセージ -->
      <div class="errors" v-if="errors">
        <ul v-if="errors">
          <li v-for="msg in errors" :key="msg.title">{{ msg }}</li>
        </ul>
      </div>

      <!-- フォーム -->
      <form class="form" v-on:submit.prevent="submit">
        <label for="report_title">タイトル <span>( {{ title_length }} / 50文字 )</span></label>
        <input type="text" class="form__item" id="report_title" v-model="reportForm.report_title" placeholder="入力必須です。50文字以内で入力してください。" autocomplete="off">
        <label for="about">副題 <span>( {{ about_length }} / 150文字)</span></label>
        <input type="text" class="form__item" id="about" v-model="reportForm.about" placeholder="こちらの入力は任意です。150文字以内で入力してください。"  autocomplete="off">
        <label for="content">本文 <span>( 入力文字数 : {{ content_length }} )</span></label>
        <textarea class="form__item form__textarea" id="content" v-model="reportForm.content" placeholder="150字以上、250字以下で入力してください。"></textarea>


        <div class="form__btn">
          <button type="submit" class="btn btn--inverse">投稿する</button>
        </div>
      </form>

    </div>
    <!--    トップへ戻る-->
    <RouterLink class="" to="/">日誌一覧へ戻る</RouterLink>

  </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../../util.js'

export default {
  data() {
    return {
      reportForm: {
        report_title: '',
        about: '',
        content: ''
      },
      errors: null
    }
  },
  computed: {
    title_length() {
      return this.reportForm.report_title.length;
    },
    about_length() {
      return this.reportForm.about.length;
    },
    content_length() {
      return this.reportForm.content.length;
    },
    user_id() {
      return this.reportForm.content.length;
    },
  },
  methods: {
    async submit () {
      const response = await axios.post('../api/reports', this.reportForm);

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

      // 投稿後にその詳細ページへ遷移させる
      this.$router.push(`/reports/${response.data.id}`)
    }
  }
}
</script>

<style scoped>

</style>