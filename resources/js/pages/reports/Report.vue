<template>
  <div class="photo">
    <h2>一覧 : Report title</h2>
    <RouterLink
        :to="`/reports/${report.id}`" :title="`Report by ${report.owner.name}`"
    >
    </RouterLink>
  </div>
  <!--投稿者名-->
  <div>
    {{ report.owner.name }}
  </div>
</template>

<script>
export default {
  name: "Report.vue"
}
</script>
