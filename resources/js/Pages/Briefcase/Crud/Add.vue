<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('briefcases-admin.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>>
    </template>

    <template #header>
      Добавление портфель
    </template>

    <div class="cec">
      <Form :form="form"
            :types="types"
            @submit="createBriefcase"/>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
export default {
  name: "Add",
  components: {
    Form: () => import('./Form'),
    MainLayout
  },
  props: {
    types: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        title: "",
        type_id: null,
        description: null,
        direct_fee: null,
        sum: null,
        profit: null,
        duration: null,
        monthly_payment: 0,
        awardable: false,
        image: null,
        '_method': 'POST',
      }, {
        bag: 'briefcaseForm',
        resetOnSuccess: false,
      })
    }
  },
  methods: {
    createBriefcase() {
      this.form.post('/briefcases-admin')
    }
  }
}
</script>
