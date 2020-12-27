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
          {{ course.progress }}%
        </p>
      </div>
      <div class="progress">
        <div class="progress-bar bg-info"
             role="progressbar" :style="`width: ${course.progress}%`"
             aria-valuenow="50"
             aria-valuemin="0" aria-valuemax="100">

        </div>
      </div>
      <inertia-link :href="route('courses.show', course.id)"
         class="main__content__courses-flex__card__button">
        Перейти на курс
      </inertia-link>
    </div>

    <div v-else>
      <div class="main__content__courses-flex__card__bottom">
        <p class="main__content__courses-flex__card__bottom__price">
          {{ course.price_without_feedback }} ₸
        </p>
        <inertia-link :href="route('courses.show', course.id)"
           class="main__content__courses-flex__card__bottom__button">
          Купить
        </inertia-link>
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
    }
  }
</script>
