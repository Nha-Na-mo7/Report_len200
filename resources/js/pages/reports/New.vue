<template>
  <div class="container--small">
    <div class="report-form">
      <h2 class="title u__mb-3l">日誌 新規作成</h2>

      <!-- エラーメッセージ -->
      <h6>エラーメッセージ</h6>

      <!-- フォーム -->
      <form class="form" v-on:submit.prevent="submit">
        <label for="report_title">タイトル</label>
        <input type="text" class="form__item" id="report_title" v-model="reportForm.report_title" placeholder="入力必須です。">
        <label for="about">副題</label>
        <input type="text" class="form__item" id="about" v-model="reportForm.about" placeholder="こちらの入力は任意です。">
        <label for="content">本文 <span>入力文字数 : {{ content_length }}</span></label>
        <textarea class="form__item form__textarea" id="content" v-model="reportForm.content" placeholder="150字以上、250字以下で入力してください。"></textarea>


        <div class="form__btn">
          <button type="submit" class="btn btn--inverse">投稿する</button>
        </div>
      </form>

    </div>

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
    content_length() {
      return this.reportForm.content.length;
    }
  },
  methods: {
    async submit () {
      console.log('New.vue : async submit()');
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