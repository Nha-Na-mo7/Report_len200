<template>
  <h1>Report List</h1>
  <div class="report-list">
    <Report
        class="report__item"
        v-for="report in reports"
        :key="report.id"
        :item="report"
    />
  </div>
</template>

<script>
import Report from "./reports/Report.vue";

export default {
  components: {
    Report
  },
  data() {
    return {
      reports: []
    }
  }
}
</script>