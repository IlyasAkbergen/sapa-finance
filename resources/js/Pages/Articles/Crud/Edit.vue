<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('articles.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Редактирование новости {{ article.title }}
    </template>

    <div class="cec">
      <Form :form="form"
            :article="article"
            @submit="updateArticle"/>
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
    article: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        ...this.article,
        ...{
          image: null,
          '_method': 'PUT',
        }
      }, {
        bag: 'articleForm',
        resetOnSuccess: true,
      }),
    }
  },
  methods: {
    updateArticle() {
      this.form.post('/articles/' + this.article.id);
    },
  }
}
</script>

<style scoped>

</style>