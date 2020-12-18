<template>
  <main-layout>
    <template #back-link>
      <a :href="route('courses-crud.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../img/back-arrow.png">
      </a>
    </template>

    <template #header>
      Что больше продается
    </template>

    <div class="statistics">
      <div v-for="course in courses">
        <p class="statistics__title">{{ course.title }}</p>
        <div class="progress">
          <div class="progress-bar" role="progressbar"
               :style="`width: ${getPercent(course)}%;`" aria-valuenow="25"
               aria-valuemin="0" aria-valuemax="100">
            Продаж ({{ course.purchases.length }})
          </div>
        </div>
      </div>
    </div>
  </main-layout>
</template>

<script>
  export default {
    name: "Stats",
    components: {
      MainLayout: () => import('@/Layouts/MainLayout')
    },
    props: {
      courses: Array
    },
    methods: {
      getPercent(course) {
        return course.purchases.length * 100
          / this.courses.map(c => c.purchases.length)
              .reduce((total, value) => total + value)
      }
    }
  }
</script>

<style scoped>

</style>