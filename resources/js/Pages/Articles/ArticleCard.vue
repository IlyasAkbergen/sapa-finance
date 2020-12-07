<template>
    <div class="main__content__news-flex__card">
        <img :src="article.imageLink"
             class="main__content__news-flex__card__img">

        <p class="main__content__news-flex__card__title">
            {{ article.title }}
        </p>

        <p class="main__content__news-flex__card__text">
            {{ article.content | truncate(180) }}
        </p>

        <a :href="route('articles.show', article.id)"
           class="main__content__news-flex__card__button">
            Читать новость
        </a>
    </div>
</template>

<script>
  export default {
    name: "ArticleCard",
    props: {
      article: Object
    }
  }
</script>
