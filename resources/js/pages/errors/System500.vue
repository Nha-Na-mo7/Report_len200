<template>
  <div class="container--small">
    <h2 class="title er-StatusCode"> - システムエラーが発生しました - </h2>
    <p class="er-StatusCode_text">ご迷惑をおかけいたしますが、しばらくお待ちください。</p>

    <!--    トップへ戻る-->
    <RouterLink class="btn" to="/">日誌一覧へ戻る</RouterLink>

  </div>

</template>

<script>
export default {
name: "System500"
}
</script>
