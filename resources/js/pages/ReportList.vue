<template>
  <div class="container--small">
    <h1 class="title">日 誌 一 覧</h1>
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