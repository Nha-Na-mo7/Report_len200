<template>
  <div class="container">
    <div v-if="isExistUser" class="mypage__container">
      <!--左サイド-->
      <div class="mypage__containerInfo">

        <div class="mypage__usernameArea">
          <div class="mypage__username">
            <p><span class="mypage__username-span">{{this.mypageUser_data.name}}</span> さんのマイページ</p>
          </div>
        </div>

        <div class="mypage__profArea">
          <p class="mypage__profile">あああああああああああああああああああああわあああああああああああああんあああああああああああああああああああああああああああああああああああああああああああフォオオおおおおおおおおおおおおおおおおおおおおおおおお秒おおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおぬううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううう。</p>
        </div>

      </div>
      <a v-if="loginUserId === this.user_id" class="btn btn--profEdit">プロフィール編集</a>

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
                @reloadReports="fetchReports"
            />
          </div>
        </div>
        <Pagination :current-page="currentPage" :last-page="lastPage"></Pagination>
      </div>
    </div>
    <!-- ユーザーが存在しないor削除された場合-->
    <div v-else>
      <div class="title">
        <h1>ユーザーが見つかりませんでした^^</h1>
        <p>削除されているか、あるいは元から存在しません。</p>
      </div>
      <RouterLink class="btn" to="/">日誌一覧へ戻る</RouterLink>
    </div>
  </div>
</template>

<script>
import { OK } from '../util.js';
import Report from "./reports/Report.vue";
import Pagination from "../components/Pagination.vue";


export default {
  props: {
    user_id: {
      type: Number,
      required: true
    },
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  components: {
    Pagination,
    Report
  },
  data() {
    return {
      reports: [],
      mypageUser_data: [],
      currentPage: 0,
      lastPage: 0
    }
  },
  computed: {
    isExistUser() {
      return this.mypageUser_data.length !== 0
    },
    loginUserId () {
      return this.$store.getters['auth/user_id']
    }
  },
  methods: {
    async fetchReports() {
      const response = await axios.get(`/api/mypage/reports/${this.mypageUser_data.id}/?page=${this.page}`);

      //エラー時
      if (response.status !== OK) {
        this.$store.commit('error/setErrorCode', response.status)
        return false
      }
      console.log(response.data.data)

      this.reports = response.data.data;
      this.currentPage = response.data.current_page
      this.lastPage = response.data.last_page
    },
    async getMypageUser() {
      const response = await axios.get(`/api/user/${this.user_id}`);
      if (response.status === OK) {
        this.mypageUser_data = response.data
      }
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.getMypageUser()
        await this.fetchReports()
      },
      immediate: true
    }
  }
}
</script>

<style scoped>

</style>