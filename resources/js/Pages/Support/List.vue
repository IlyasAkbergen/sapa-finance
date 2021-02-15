<template>
    <main-layout>
        <template #header>
            Список запросов на поддержку
        </template>
        <div class="row">

            <template v-if="items.length">
                <div class="col-12" v-for="item in items">
                    <div class="my-3 card">
                        <div class="card-body row">
                            <div class="col-12 col-sm-2 d-flex justify-content-center align-items-center">
                                <div>
                                    <img class="rounded-full h-20 w-20 object-cover"
                                         :src="item.user.profile_photo_path">
                                    <inertia-link :href="route('users.show', item.user.id)" class="d-block">
                                        {{item.user.name}}
                                    </inertia-link>
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <p>
                                    {{item.message}}
                                </p>

                                <p class="text-muted">
                                    Прикрепленные файлы
                                </p>
                                <Attachments
                                        class="d-block"
                                        :model-id="item.id"
                                        :model-type="'support'"
                                        :onlyShow="true"
                                />
                                <div class="text-right">
                                    <a @click="() => {
                                deleteAcceptModalShow = !deleteAcceptModalShow;
                                itemToDelete = item;
                                }">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="col-12">
                    <Empty/>
                </div>
            </template>

        </div>
        <DeleteAcceptModal :show="deleteAcceptModalShow"
                           @close="cancelDelete"
                           @accepted="deleteItem"/>
    </main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    import Attachments from '@/Shared/Attachments';

    export default {
        name: "List",
        components: {
            MainLayout,
            Attachments,
            DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal'),
            Empty: () => import('@/Shared/Empty'),
        },
        props: {
            items: Array
        },
        data: () => {
            return {
                deleteAcceptModalShow: false,
                itemToDelete: null,
            }
        },
        methods: {
            deleteItem() {
                if (this.itemToDelete) {
                    this.$inertia.delete(route('supports.destroy', this.itemToDelete));
                }
            },
            cancelDelete() {
                this.deleteAcceptModalShow = !this.deleteAcceptModalShow;
            }
        }
    }
</script>

<style scoped>

</style>
