<template>
    <main-layout>
        <template #header>
            Новости
        </template>

        <template #actions>
            <div class="actions" v-if="isAdmin">
                <search-bar
                        :value="search_key"
                        @input="input => search_key = input"
                />

                <a class="actions__link actions__link--green"
                   :href="route('articles.create')">
                    <span>Добавить новость</span>
                </a>
            </div>
        </template>

        <div class="main__content__news-flex">
            <ArticleCard v-for="article in articles"
                :article="article"
                :key="article.id"
            />
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import HasUser from "@/Mixins/HasUser";
export default {
    name: "Index",
    mixins: [HasUser],
    components: {
        MainLayout,
        ArticleCard: () => import('./ArticleCard'),
        Pagination: () => import('@/Shared/Pagination'),
        SearchBar: () => import('@/Shared/SearchBar'),
    },
    props: {
        articles: Array
    },
    data() {
        return {
            search_key: ""
        }
    }
}
</script>
