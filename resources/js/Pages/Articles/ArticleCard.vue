<template>
    <div class="main__content__news-flex__card">
        <img :src="article.image_path"
             class="main__content__news-flex__card__img">

        <p class="main__content__news-flex__card__title">
            {{ article.title }}
        </p>

        <p class="main__content__news-flex__card__text">
            {{ article.content | truncate(180) }}
        </p>

        <p class="main__content__news-flex__card__text text-muted">
            {{ article.created_at }}
        </p>

        <div class="text-center" v-if="isAdmin">
            <a :href="route('articles.show', article.id)"
               class="users__link users__link--green">
                <GreenEye />
            </a>
            <a :href="route('articles.edit', article.id)"
               class="users__link users__link--blue">
                <Pencil />
            </a>
            <a href="#" @click.prevent="() => deleteArticle(article.id)"
                class="users__link users__link--red new__delete">
                <Trash />
            </a>
        </div>

        <a :href="route('articles.show', article.id)"
           v-else
           class="main__content__news-flex__card__button">
            Читать новость
        </a>
    </div>
</template>

<script>
import HasUser from "@/Mixins/HasUser";
import GreenEye from "@/assets/icons/GreenEye";
import Pencil from "@/assets/icons/Pencil";
import Trash from "@/assets/icons/Trash";

export default {
    name: "ArticleCard",
    components: {
        Trash,
        Pencil,
        GreenEye
    },
    mixins: [HasUser],
    props: {
      article: Object
    },
    methods: {
        deleteArticle(id) {
            this.$inertia.delete(route('articles.destroy', id));
        }
    }
}
</script>
