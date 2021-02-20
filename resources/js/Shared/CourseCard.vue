<template>
  <inertia-link :href="route('courses.show', course.id)">
    <div class="main__content__courses-flex__card clickable">
      <img :src="imagePath"
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
          <span
            v-if="course.status && course.status == 1"
            style="vertical-align: super; color: #5FADE5; text-transform: uppercase; font-size: 14px; font-weight: bold; margin-right: 5px;">
                Запрос отправлен
          </span>
          <inertia-link :href="route('courses.show', course.id)"
             v-else
             class="main__content__courses-flex__card__bottom__button">
            Подробнее
          </inertia-link>
        </div>
      </div>
    </div>
  </inertia-link>
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
    computed: {
    	imagePath() {
    		return this.course.image_path
          ? this.course.image_path
          : '/images/course-card-img.png';
      }
    }
  }
</script>
