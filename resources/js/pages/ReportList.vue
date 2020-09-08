<template>
  <div class="container--small">
    <h1 class="title">日誌一覧</h1>
    <div class="report-list">
      <div class="grid">
        <Report
            class="report__item"
            v-for="report in reports"
            :key="report.id"
            :item="report"
            @reloadReports="fetchReports"
        />
      </div>
      <Pagination :current-page="currentPage" :last-page="lastPage"></Pagination>
    </div>
  </div>


</template>

<script>
import { OK } from '../util.js';
import Report from "./reports/Report.vue";
import Pagination from "../components/Pagination.vue";

export default {
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  components: {
    Report,
    Pagination
  },
  data() {
    return {
      reports: [],
      currentPage: 0,
      lastPage: 0
    }
  },
  methods: {
    async fetchReports() {
      const response = await axios.get(`/api/reports/?page=${this.page}`);

      // エラー時
      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }

      this.reports = response.data.data
      this.currentPage = response.data.current_page
      this.lastPage = response.data.last_page
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