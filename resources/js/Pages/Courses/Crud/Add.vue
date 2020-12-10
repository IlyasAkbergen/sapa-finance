<template>
    <main-layout>
        <template #back-link>
            <a :href="route('courses-crud.index')"
               class="navbar-brand mb-0">
                <img src="../../../../img/back-arrow.png" alt="">
            </a>
        </template>

        <template #header>
            Добавление курса
        </template>

        <div class="cec">
            <Form :course="course"
                  :form="form"
                  @submit="createCourse"/>
        </div>
    </main-layout>
</template>

<script>
  export default {
    name: "Add",
    components: {
      Form: () => import('./Form'),
      MainLayout: () => import('@/Layouts/MainLayout')
    },
    data() {
      return {
        course: {},
        form: this.$inertia.form({...this.course}, {
          resetOnSuccess: false,
          bag: 'courseForm',
        })
      }
    },
    methods: {
      createCourse() {
        this.form.post(route('courses-crud.store', this.course), {
          preserveScroll: true
        }).then((r) => console.log(r.data))
      }
    }
  }
</script>

<style scoped>

</style>