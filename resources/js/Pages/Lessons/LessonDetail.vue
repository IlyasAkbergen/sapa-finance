<template>
  <main-layout>
    <template #back-link>
      <a :href="route('courses.show', lesson.course_id)"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../img/back-arrow.png">
      </a>
    </template>

    <template #header>
      {{ lesson.title }}
    </template>

    <div class="main__content__lesson-flex">
      <div class="main__content__lesson-card">
        <p class="main__content__lesson-card__title">{{ lesson.title }}</p>
        <p class="main__content__lesson-card__text">
          {{ lesson.content }}
        </p>
        <p class="main__content__lesson-card__video-title">Видео</p>
        <iframe class="w-100"
                height="300"
                :src="lesson.video_url">
        </iframe>

        <p class="main__content__lesson-card__materials-title mt-2">Материалы</p>
        <div class="main__content__lesson-card__materials">
          <Attachments
            :modelType="'lesson'"
            :modelId="lesson.id"
            :uuid="null"
            :slug="'lesson'"
            :only-show="true"
            ref="homework_attachments"
          />
        </div>
<!--        <a :href="lesson.attachment_path"-->
<!--           class="main__content__lesson-card__materials-button">-->
<!--          Скачать материалы-->
<!--        </a>-->
      </div>
      <div class="main__content__lesson-flex__task">
        <div class="main__content__lesson-flex__task__homework">
          <p class="main__content__lesson-flex__task__homework__title">
            Домашнее задание
          </p>

          <Attachments
              :model-id="lesson.user_homework.id"
              :model-type="'homework'"
              :uuid="null"
          />
        </div>
        <div class="main__content__lesson-flex__task__grade">
          <p class="main__content__lesson-flex__task__grade__title">Оценка</p>
          <div class="progress blue" v-if="lesson.user_homework.score">
            <span class="progress-left">
                <span class="progress-bar"></span>
            </span>
            <span class="progress-right">
                <span class="progress-bar"></span>
            </span>
            <div class="progress-value">
              {{ lesson.user_homework.score }}%
            </div>
          </div>
          <div class="align-content-center">
            Не оценено
          </div>
        </div>
        <a :href="route('next_lesson', {
              id: lesson.course_id,
              lesson_id: lesson.id
            })"
           v-if="lesson.has_next_lesson"
           class="main__content__lesson-flex__task__next active">
          К следующему уроку
          <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.58958 0.910704C9.26414 0.585267 8.73651 0.585267 8.41107 0.910704C8.08563 1.23614 8.08563 1.76378 8.41107 2.08922L14.4885 8.16663H1.50033C1.04009 8.16663 0.666992 8.53972 0.666992 8.99996C0.666992 9.4602 1.04009 9.83329 1.50033 9.83329H14.4885L8.41107 15.9107C8.08563 16.2361 8.08563 16.7638 8.41107 17.0892C8.73651 17.4147 9.26414 17.4147 9.58958 17.0892L17.0896 9.58922C17.415 9.26378 17.415 8.73614 17.0896 8.4107L9.58958 0.910704Z"/>
          </svg>
        </a>
      </div>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";

export default {
  name: "LessonDetail",
  components: {
		MainLayout,
		Attachments: () => import('@/Shared/Attachments'),
  },
  props: {
  	lesson: Object,
  },
  data() {
  	return {

    }
  }
}
</script>
