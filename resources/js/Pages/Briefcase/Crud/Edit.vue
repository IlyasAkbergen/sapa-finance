<template>
  <main-layout>
    <template #back-link>
      <a :href="route('briefcases-admin.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </a>
    </template>

    <template #header>
      Редактирование портфеля {{ briefcase.title }}
    </template>

    <div class="cec">
      <Form :form="form"
            :course="briefcase"
            :types="types"
            @submit="updateBriefcase"/>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";

export default {
  name: "Edit",
  components: {
    Form: () => import('./Form'),
    MainLayout,
  },
  props: {
    briefcase: Object,
    types: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        ...this.briefcase,
        ...{
          image: null,
          '_method': 'PUT',
        }
      }, {
        bag: 'briefcaseForm',
        resetOnSuccess: true,
      }),
    }
  },
  methods: {
    updateBriefcase() {
      this.form.post('/briefcases-admin/' + this.briefcase.id);
    },
  }
}
</script>
