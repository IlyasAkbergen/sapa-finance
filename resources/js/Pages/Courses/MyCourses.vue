<template>
  <main-layout>
    <template #header>
      Курсы
    </template>
    <div class="main__content__agent-my-courses-flex"
         v-if="courses && courses.length > 0">
       <CourseCard v-for="course in courses"
                  :course="course"
                  :bought="course.bought"
                  :key="course.id" />
    </div>
    <div class="main__content__agent-empty-courses" v-else>
      <p class="main__content__empty-courses__text">У вас пока нету преобретенных курсов</p>
      <inertia-link :href="route('courses.index')" class="main__content__empty-courses__button">
        Перейти к курсам
      </inertia-link>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  export default {
    components: {
      MainLayout,
      CourseCard: () => import('../../Shared/CourseCard')
    },
    props: ['courses']
  }
</script>
