<template>
  <div class="main__content__courses-flex__card">
    <img src="../../img/course-card-img.png"
         class="main__content__courses-flex__card__img"
         alt="">
    <p class="main__content__courses-flex__card__title">
      {{ course.title }}
    </p>

    <div v-if="bought">
      <div class="main__content__courses-flex__card__process">
        <p class="main__content__courses-flex__card__process__title">
          Процесс обучения
        </p>
        <p class="main__content__courses-flex__card__process__percent">
          {{ course.progress_percent }}%
        </p>
      </div>
      <div class="progress">
        <div class="progress-bar bg-info"
             role="progressbar" :style="`width: ${course.progress_percent}%`"
             aria-valuenow="50"
             aria-valuemin="0" aria-valuemax="100">

        </div>
      </div>
      <a :href="route('courses.show', course.id)"
         class="main__content__courses-flex__card__button">
        Перейти на курс
      </a>
    </div>

    <div v-else>
      <div class="main__content__courses-flex__card__bottom">
        <p class="main__content__courses-flex__card__bottom__price">
          {{ course.price_without_feedback }} ₸
        </p>
        <a :href="route('courses.show', course.id)"
           class="main__content__courses-flex__card__bottom__button">
          Купить
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "CourseCard",
    props: {
      course: Object,
      bought: {
        type: Boolean,
        default: false
      }
    },
    created() {
      console.log('course: ' + this.course)
    }
  }
</script>
