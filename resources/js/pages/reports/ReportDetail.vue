<template>
  <div class="container">

    <div class="report-detail">
      <h1 class="report-detail__title">{{ this.report.report_title }}</h1>
      <h2 class="report-detail__about">{{ this.report.about }}</h2>
      <div class="report-detail__info">
        <span class="report-detail__date">{{ this.report.created_at | moment }}</span>
        <span class="report-detail__username">{{ this.report.owner.name }}</span>
      </div>
      <div class="report-detail__content-area">
        <span class="report-detail__content">或日の暮方の事である。<br>
          一人の下人が、羅生門の下で雨やみを待つてゐた。
          廣い門の下には、この男の外に誰もゐない。唯、所々丹塗の剥げた、大きな圓柱に、蟋蟀が一匹とまつてゐる。<br>
          羅生門が、朱雀大路にある以上は、この男の外にも、雨やみをする市女笠や揉烏帽子が、もう二三人にんはありさうなものである。<br>
          それが、この男の外には誰もゐない。一匹とまつてゐる。<br>
          羅生門が、朱雀大路にある以上は、この男の外にも、雨やみをする市女笠や揉烏帽子が、もう二三人にんはありさうなものである。<br>それが、この男の外には誰もゐない。</span>
      </div>
    </div>

    <!--コメント欄-->
    <h2 class="report-detail__commentTitle">コメント</h2>
    <ul class="report-detail__comments">
      <li class="report-detail__commentItem">
        <p class="report-detail__commentText">
          草<br>
        何がしたいのか</p>
        <p class="report-detail__commentInfo">やきう 2020/08/26 15:25</p>
      </li>
      <li class="report-detail__commentItem">
        <p class="report-detail__commentText">は？</p>
        <p class="report-detail__commentInfo">投稿主 2020/08/26 15:25</p>
      </li>
      <li class="report-detail__commentItem">
        <p class="report-detail__commentText">334</p>
        <p class="report-detail__commentInfo">2161667676 2020/08/26 15:25</p>
      </li>
    </ul>

    <!--コメント投稿フォーム-->
    <h2 class="report-detail__commentTitle">投稿する</h2>
    <form @submit.prevent="" class="form">

      <textarea class="form__item form__textarea"></textarea>
      <div class="form__btn">
        <button class="btn btn--inverse">コメントを送信</button>
      </div>
    </form>

  </div>
</template>

<script>
import { OK } from '../../util.js';
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
      content: null
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
    moment: function (date) {
      return moment(date).format('YYYY年M月D日 HH時mm分')
    }
  }
}
</script>

<style scoped>

</style>