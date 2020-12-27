<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="route('articles.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../img/back-arrow.png" alt="">
            </inertia-link>
        </template>

        <template #header>
            {{ article.title }}
        </template>

        <div class="main__content__agent-new-card">
            <img :src="article.image_path"
                 class="main__content__new-card__img" alt="">
            <p class="main__content__new-card__title">
                {{ article.title }}
            </p>
            <p class="main__content__new-card__text">
                {{ article.content }}
            </p>
            <p class="main__content__news-flex__card__text text-muted">
                {{ article.created_at }}
            </p>
            <inertia-link :href="route('articles.show', article.id + 1)"
               class="main__agent-next-new-button d-flex">
                <span>К следующей новости</span>
                <img src="../../../img/next-lesson-arrow.png"
                     class="main__next-new-button__img">
            </inertia-link>
        </div>
    </main-layout>
</template>

<script>
  import MainLayout from "@/Layouts/MainLayout";
  export default {
    name: "ArticleDetail",
    components: {
      MainLayout
    },
    props: {
      article: Object
    }
  }
</script>

<style scoped>

</style>