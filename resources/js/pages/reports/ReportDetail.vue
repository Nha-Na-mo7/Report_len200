<template>
  <div class="container">

    <!--レポート詳細部分-->
    <div class="report-detail">
      <h1 class="report-detail__title">{{ this.report.report_title }}</h1>
      <h2 class="report-detail__about">{{ this.report.about }}</h2>
      <div class="report-detail__info">
        <span class="report-detail__date">{{ this.report.created_at | moment_report }}</span>
        <span class="report-detail__username">{{ this.report.owner.name }}</span>
      </div>
      <div class="report-detail__content-area">
        <span class="report-detail__content">{{ this.report.contents.content }}</span>
      </div>
    </div>

    <!--コメント欄-->
    <h2 class="report-detail__commentTitle">コメント</h2>
    <ul v-if="report.comments.length > 0" class="report-detail__comments">
      <li
          v-for="comment in report.comments"
          :key="comment.comment"
          class="report-detail__commentItem"
      >
        <p class="report-detail__commentText">
          {{ comment.comment }}
        </p>
        <p class="report-detail__commentInfo">
          {{ comment.author.name }}
          <span class="report-detail__date">{{ comment.created_at | moment_comment }}</span>
        </p>
      </li>
    </ul>
    <ul v-else class="report-detail__comments">
      <li class="report-detail__commentItem">
        <p class="report-detail__commentText u-glay">
          ( コメントは投稿されていません )
        </p>
      </li>
    </ul>

    <!--コメント投稿フォーム-->
    <h2 v-if="isLogin" class="report-detail__commentTitle">投稿する</h2>
    <form v-if="isLogin" @submit.prevent="addComment" class="form">
      <textarea class="form__item form__textarea" v-model="commentContent"></textarea>
      <div class="form__btn">
        <button type="submit" class="btn btn--inverse">コメントを送信</button>
      </div>
    </form>

  </div>
</template>

<script>
import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../../util.js';
import moment from 'moment';

export default {
  props: {
    report_id: {
      type: String,
      required: true
    }
  },
  data() {
    return{
      report: null,
      commentContent: '',
      commentErrors: null
    }
  },
  computed: {
    isLogin() {
      return this.$store.getters['auth/loginCheck']
    }
  },
  methods: {
    async fetchReport() {
      const response = await axios.get(`/api/reports/${this.report_id}`);

      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status);
        return false
      }
      this.report = response.data
    },
    // コメント投稿
    async addComment() {
      const response = await axios.post(`/api/reports/${this.report_id}/comments`, {
        comment: this.commentContent
      })
      // バリデーション
      if(response.status === UNPROCESSABLE_ENTITY) {
        this.commentErrors = response.data.errors
        return false
      }
      // 投稿フォームクリア
      this.commentContent = '';
      // エラーメッセージクリア
      this.commentErrors = null
      // その他エラー(201以外の何かの時)
      if(response.status !== CREATED) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }
      this.report.comments = [
          response.data,
          ...this.report.comments
      ]

    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchReport()
      },
      immediate: true
    }
  },
  filters: {
    moment_report: function (date) {
      return moment(date).format('YYYY年M月D日 HH時mm分')
    },
    moment_comment: function (date) {
      return moment(date).format('YYYY/M/D HH:mm')
    }
  }
}
</script>

<style scoped>

</style>