<template>
    <main-layout>
        <template #back-link>
            <a :href="route('articles.index')" class="navbar-brand mb-0">
                <img src="../../../img/back-arrow.png" alt="">
            </a>
        </template>

        <template #header>
            {{ article.title }}
        </template>

        <div class="main__content__agent-news-flex">

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