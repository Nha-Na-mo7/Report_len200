<template>
  <div class="report-form">
    <h2 class="title">日誌 新規作成</h2>

    <!-- エラーメッセージ -->

    <!-- フォーム -->
    <form class="form" v-on:submit.prevent="submit">
      <label for="report_title">タイトル</label>
      <input type="text" class="form__item" id="report_title">
      <label for="about">副題(任意)</label>
      <input type="text" class="form__item" id="about">
      <label for="content">本文</label>
      <textarea class="form__item" id="content"></textarea>
      <div class="form__button">
        <button type="submit" class="button button--inverse">投稿する</button>
      </div>
    </form>

    <h6>文字数カウンタ(未作成) + twitter風の円形文字数カウンタ</h6>
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
      this.$router.push('/reports/${response.data.id}')
    }
  }
}
</script>

<style scoped>

</style>