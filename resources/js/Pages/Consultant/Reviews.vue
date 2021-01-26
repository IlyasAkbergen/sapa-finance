<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="route('consultants-crud.index')"
                          class="navbar-brand mb-0 pb-0">
                <img src="../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Отзывы консультанта {{ reviewedUser.name }}
        </template>

        <div class="c-feeds-wrapper" v-if="reviews.length > 0">
            <div class="c-feed" v-for="review in reviews"
                 :key="review.id"
            >
                <div class="c-feed__info">
                    <div class="c-feed__header">
                        <div class="c-feed__avatar">
                            <img :src="review.from_user.profile_photo_path
                ? review.from_user.profile_photo_path
                : '/images/avatar-empty.png'">
                        </div>
                        <div class="c-feed__user-info">
                            <p class="c-feed__username">
                                {{ review.from_user.name }}
                            </p>
                            <p class="c-feed__date">
                                {{ review.created_at }}
                            </p>
                        </div>
                    </div>
                    <div class="c-feed__content">
                        {{ review.content }}
                    </div>
                </div>
                <div class="c-feed__action">
                    <a class="c-feed__link c-feed__link--red"
                       @click.prevent="deleteClicked(review.id)"
                    >
                        <Trash/>
                    </a>
                </div>
            </div>
        </div>
        <span v-else>Нет отзывов</span>
        <DeleteAcceptModal :show="deleteAcceptModalShow"
                           @close="cancelDelete"
                           @accepted="deleteReview"/>
    </main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    import Pagination from "@/Shared/Pagination";

    export default {
        name: "Reviews",
        components: {
            MainLayout,
            Pagination,
            DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal'),
            Trash: () => import('@/assets/icons/Trash')
        },
        props: {
            data: Object,
            reviewedUser: Object
        },
        data() {
            return {
                itemToBeDeleted: null,
                deleteAcceptModalShow: false
            }
        },
        methods: {
            deleteClicked(id) {
                this.itemToBeDeleted = id;
                this.deleteAcceptModalShow = true
            },
            deleteReview() {
                this.$inertia.delete(route('reviews-crud.destroy', this.itemToBeDeleted));
            },
            cancelDelete() {
                this.deleteAcceptModalShow = false
                this.itemToBeDeleted = null
            }
        },
        computed: {
            reviews() {
                return this.data.data;
            },
        }
    }
</script>

<style scoped>

</style>