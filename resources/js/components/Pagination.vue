<template>
  <!-- ページネーション用のコンポーネント -->
  <div class="pagination">
    <RouterLink
        v-if="! isFirstPage"
        :to="`${this.currentPath}?page=${currentPage - 1}`"
        class="btn c-btn"
    >&laquo; PREV</RouterLink>
    <RouterLink
        v-if="! isLastPage"
        :to="`${this.currentPath}?page=${currentPage + 1}`"
        class="btn c-btn"
    >NEXT &raquo;</RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    lastPage: {
      type: Number,
      required: true
    }
  },
  data(){
    return {
      currentPath: this.$route.path
    }
  },
  computed: {
    isFirstPage() {
      return this.currentPage ===  1
    },
    isLastPage() {
      return this.currentPage === this.lastPage
    }
  }
}
</script>

<style scoped>

</style>