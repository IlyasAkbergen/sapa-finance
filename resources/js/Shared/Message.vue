<template>
  <transition
          enter-active-class="transition ease-out duration-200"
          enter-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-1000"
          leave-class="opacity-100"
          leave-to-class="opacity-0">
    <div class="main__content__course-success pointable"
         v-show="flashMessage">
      <div class="main__content__course-success__left">
        <img src="../../img/lesson-icon-passed.png">
      </div>
      <div class="main__content__course-success__right">
        <i class="fas fa-times fa-sm"></i>
        <p class="main__content__course-success__right__title"
           v-show="flashMessage">
          {{ flashMessage }}
        </p>
      </div>
    </div>
<!--    <flash-message class="myCustomClass"></flash-message>-->
  </transition>
</template>

<script>
  export default {
    name: "Message",
    props: {
      flashMessage: String
    }
  }
</script>
