<template>
    <main-layout>

        <template #back-link>
            <inertia-link :href="route('partner-cabinet.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Программы
        </template>

        <template #actions>
            <div class="actions">
                <span>Список программ</span>
                <a class="actions__link actions__link--green" @click="showModal=true">
                    <span>Добавить программу на сайт</span>
                </a>
            </div>
        </template>
        <Modal :show="showModal" :max-width="'sm'" :closeable="true" @close="showModal=false">
            <inertia-link class="modal-link" v-for="type in types"
                          :href="route('programs.create', {id: type.id})">{{type.title}}</inertia-link>
        </Modal>
        <div class="main__content__agent-portfels-flex">
            <BriefcaseCard v-for="briefcase in briefcases"
                           :briefcase="briefcase"
                           :key="briefcase.id" />
        </div>
    </main-layout>
</template>

<script>
    export default {
        name: "Index",
        components: {
            MainLayout: () => import('@/Layouts/MainLayout'),
            BriefcaseCard: () => import('@/Pages/Briefcase/BriefcaseCard'),
            Modal: () => import('@/Jetstream/Modal')
        },
        props: {
            briefcases: Array,
            types: Array,
        },
        data() {
            return {
                showModal: false,
            }
        }
    }
</script>

<style scoped>
    .modal-link{
        position: static;
        width: 141px;
        height: 25px;
        left: 0;
        top: 0;
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        line-height: 140%;
        display: flex;
        align-items: center;
        color: #190134;
        flex: none;
        order: 0;
        flex-grow: 0;
        margin-bottom: 10px;
    }
</style>
