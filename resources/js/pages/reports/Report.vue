<template>
  <div class="reports">
    <div class="reports__main">
      <span class="reports__date">{{ item.created_at | moment }}</span>
      <span class="reports__username">{{ item.owner.name }}</span>
    </div>
    <h2 class="reports__title">{{ item.report_title }}</h2>
    <p class="reports__about--title">about...</p>
    <p class="reports__about">{{ item.about }}</p>
    <RouterLink
    class="report__overlay"
    :to="`/reports/${item.id}`"
    :title="`${item.report_title}`"
    >
    </RouterLink>
    <button class="btn btn--destroy" v-on:click="destroyReport">削除</button>


  </div>

</template>

<script>
// DBのcreated_atを任意の日付フォーマットに変更するライブラリ
import moment from 'moment';

export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      currentPath: this.$route.path
    }
  },
  methods: {
    async destroyReport() {
      const response = await axios.delete(`/api/reports/${this.item.id}`)

      this.emitFetchReports();

    },
    async emitFetchReports() {
      console.log('emitFetchReports')
      this.$emit('reloadReports');
    }
  },
  filters: {
    moment: function (date) {
      return moment(date).format('YY/M/D HH:mm')
    }
  }
}
</script>

<!--まだの箇所-->
