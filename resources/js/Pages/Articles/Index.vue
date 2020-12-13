<template>
    <main-layout>
        <template #header>
            Новости
        </template>

        <div class="main__content__agent-news-flex">  c
            <ArticleCard v-for="article in articles"
                :article="article"
                 :key="article.id"
            />
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
export default {
  name: "Index",
  components: {
    MainLayout,
    ArticleCard: () => import('./ArticleCard')
  },
  props: {
    articles: Array
  }
}
</script>
