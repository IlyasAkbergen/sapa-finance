<template>
  <div class="main__content__course-success">
    <div class="main__content__course-success__left">
      <img src="../../img/lesson-icon-passed.png" alt="">
    </div>
    <div class="main__content__course-success__right">
      <i class="fas fa-times fa-sm"></i>
      <p class="main__content__course-success__right__title">
        {{ $page.flash.message }}
      </p>
      <p class="main__content__course-success__right__text">
        {{ $page.flash.message }}
      </p>
    </div>
  </div>
</template>

<script>
  export default {
    name: "FlashMessage",
  }
</script>

<style scoped>

</style>