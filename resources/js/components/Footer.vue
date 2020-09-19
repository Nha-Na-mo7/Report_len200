<template>
  <footer class="footer">
    <div>
      <h3>{{ nowtime }}</h3>
      <span>©️ Copyright 2020</span>
      <span>Laravel + Vue アウトプット</span>
    </div>
  </footer>
</template>

<script>
export default {
  computed: {
    nowtime() {
      return new Date().toLocaleString();
    },
  }
}
</script>
