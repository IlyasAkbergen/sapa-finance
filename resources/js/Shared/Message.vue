<template>
  <transition
          enter-active-class="transition ease-out duration-500"
          enter-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-500"
          leave-class="opacity-100"
          leave-to-class="opacity-0">
    <div :class="`main__content__course-success pointable clickable`"
         @click="hide = true"
         v-show="message && !hide">
      <div :class="`main__content__course-success__left`">
        <img src="../../img/lesson-icon-passed.png">
      </div>
      <div :class="`main__content__course-success__right`">
        <i class="fas fa-times fa-sm"
           @click="hide = true"
        />
        <p :class="`main__content__course-success__right__title`"
           v-show="message">
          {{ message }}
        </p>
      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: "Message",
    props: {
      message: {
        type: String|Array,
        default: null
      },
      type: String
    },
    data() {
      return {
        hide: false
      }
    }
  }
</script>
