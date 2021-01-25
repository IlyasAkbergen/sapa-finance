<template>
  <main-layout>
    <template #header>
      Cтатистика продаж
    </template>

    <div class="statistics">
      <div v-for="item in data">
        <p class="statistics__title">{{ item.title }}</p>
        <div class="progress">
          <div class="progress-bar" role="progressbar"
               :style="`width: ${getPercent(item)}%;`" aria-valuenow="25"
               aria-valuemin="0" aria-valuemax="100">
            Договоров ({{ item.count }})
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
      data: Array
    },
    methods: {
      getPercent(item) {
        return item.count * 100
          / this.data.map((i) => i.count).reduce((total, value) => total + value)
      }
    }
  }
</script>

<style scoped>
  .statistics {
    max-width: 80% !important;
  }
</style>
