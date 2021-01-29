<template>
  <main-layout>
    <template #header>
      Добавление информации об агентах
    </template>

    <div class="cec">
      <Form :form="form"
            @submit="createCourse"/>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import {uuid} from 'vue-uuid'

  export default {
    name: "Add",
    components: {
      Form: () => import('./Form'),
      MainLayout
    },
    data() {
      return {
        form: this.$inertia.form({
          title: "",
          tag: 'is_became_agent',
          price_with_feedback: null,
          price_without_feedback: null,
          direct_fee: null,
          short_description: null,
          description: null,
          uuid: uuid.v1(),
          is_online: 0,
          is_offline: 0,
          team_points: 0,
          direct_points: 0,
          image: null,
          '_method': 'POST',
        }, {
          bag: 'courseForm',
          resetOnSuccess: false,
        })
      }
    },
    methods: {
      createCourse() {
        this.form.post('/courses-crud');
      },
    }
  }
</script>
