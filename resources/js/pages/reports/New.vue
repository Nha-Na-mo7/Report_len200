<template>
  <div class="report-form">
    <h2 class="title">日誌 新規作成</h2>

    <!-- エラーメッセージ -->


    <!-- フォーム -->
    <form class="form" v-on:submit.prevent="">
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      reportForm: {
        report_title: '',
        about: '',
        content: ''
      }
    }
  }
}
</script>

<style scoped>

</style>