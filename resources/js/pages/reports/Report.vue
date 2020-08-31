<template>
  <div class="reports">
    <div class="reports__main">
      <span class="reports__date">{{ item.created_at | moment }}</span>
      <span class="reports__username">{{ item.owner.name }}</span>
    </div>
    <h2 class="reports__title">{{ item.report_title }}</h2>
    <RouterLink
        class="report__overlay"
        :to="`/reports/${item.id}`"
        :title="`{{${item.report_title}}}`"
    >
    </RouterLink>
    <p class="reports__about--title">about...</p>
    <p class="reports__about">{{ item.about }}</p>
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
  filters: {
    moment: function (date) {
      return moment(date).format('YY/M/D HH:mm')
    }
  }
}
</script>
