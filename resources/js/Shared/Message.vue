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
      <div :class="`main__content__course-success__left ${type === 'error' ? 'danger-left' : ''}`">
        <img :src="type === 'success'
          ? '/images/lesson-icon-passed.png'
          : '/images/success-times-icon.png'">
        <!--   times вроде как крестик, и не может в принципе сочетаться с "success"
          все равно что текст ошибки писать зеленым цветом
         -->
      </div>
      <div :class="`main__content__course-success__right ${type === 'error' ? 'danger-right' : ''}`">
        <i class="fas fa-times fa-sm"
           @click="hide = true"
        />
        <p :class="`main__content__course-success__right__title`"
           v-show="message">
          {{ message }}
        </p>
        <p :class="`main__content__course-${type}__right__subtitle`"
           v-if="subMessage">
          {{ subMessage }}
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
      subMessage: {
        type: String,
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

<style scoped>
  /* песдец конеш классы, facepalm */
  .danger-left {
    background-color: #EE5252 !important; /* сока испортант */
    border: 1px solid #EE5252 !important;
  }

  .danger-right {
    border: 1px solid #EE5252 !important;
  }
</style>
