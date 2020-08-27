<template>
  <div class="reports">
    <div class="reports__main">
      <span class="reports__date">2020/8/27 12:22:30</span>
      <span class="reports__username">ユーザーネーム</span>
    </div>
    <h2 class="reports__title">Report title</h2>
<!--    <RouterLink-->
<!--        class="report__overlay"-->
<!--        :to="`/reports/${report.id}`" -->
<!--        :title="`Report by ${report.owner.name}`"-->
<!--    >-->
<!--    </RouterLink>-->
    <p class="reports__about--title">about...</p>
    <p class="reports__about">或日の暮方の事である。一人の下人が、羅生門の下で雨やみを待つてゐた。廣い門の下には、この男の外に誰もゐない。</p>

    <!--  <div class="report__username">-->
    <!--    {{ report.owner.name }}-->
    <!--  </div>-->
  </div>



</template>

<script>
export default {
  name: "Report.vue"
}
</script>
