<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('articles.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>>
    </template>

    <template #header>
      Добавление новости
    </template>

    <div class="nan">
      <Form :form="form"
            @submit="createArticle"/>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import { uuid } from "vue-uuid";

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
        content: null,
        uuid: uuid.v1(),
        image: null,
        created_at: null,
        '_method': 'POST',
      }, {
        bag: 'articleForm',
        resetOnSuccess: false,
      })
    }
  },
  methods: {
      createArticle() {
          this.form.post('/articles')
      }
  }
}
</script>
