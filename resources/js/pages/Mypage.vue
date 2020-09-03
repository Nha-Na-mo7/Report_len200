<template>
  <div class="container">
    <div class="mypage__container">

      <!--左サイド-->
      <div class="mypage__containerInfo">
        <div class="mypage__username">
          <span>ユーザーネーム</span>
        </div>
        <div class="mypage__userInfo">
          <span>投稿 : 0</span>
        </div>
      </div>

      <!--右サイド-->
      <div class="mypage__containerReports">
        <h1 class="title">投稿済み日誌</h1>
        <div class="report-list">
          <div class="grid">
            <Report
                class="report__item"
                v-for="report in reports"
                :key="report.id"
                :item="report"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { OK } from '../util.js';
import Report from "./reports/Report.vue";

export default {
  components: {
    Report
  },
  data() {
    return {
      reports: []
    }
  },
  methods: {
    async fetchReports() {
      const response = await axios.get('/api/reports');

      //エラー時
      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }
      console.log(response.data.data)

      this.reports = response.data.data;
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchReports()
      },
      immediate: true
    }
  }
}
</script>

<style scoped>

</style>