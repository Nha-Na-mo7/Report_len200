<template>
  <h1>Report List</h1>
<!--  <div class="report-list">-->
<!--    <Report-->
<!--        class="report__item"-->
<!--        v-for="report in reports"-->
<!--        :key="report.id"-->
<!--        :item="report"-->
<!--    />-->
<!--  </div>-->
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

      // エラー時
      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }

      this.reports = response.data.data
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