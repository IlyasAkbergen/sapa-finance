<template>
    <main-layout>

        <template #back-link>
            <a :href="route('partner-cabinet.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../img/back-arrow.png">
            </a>
        </template>


        <template #actions>
            <div class="actions">
                <span>Список программ</span>
                <inertia-link class="actions__link actions__link--green"
                              :href="route('articles.create')">
                    <span>Добавить программу на сайт</span>
                </inertia-link>
            </div>
        </template>

        <div class="main__content__courses-flex">
            <CourseCard v-for="course in courses"
                        :course="course"
                        :key="course.id" />
        </div>
    </main-layout>
</template>

<script>
    export default {
        name: "Index",
        components: {
            MainLayout: () => import('@/Layouts/MainLayout')
        },
        props: {
            programs: Object
        }
    }
</script>

<style scoped>

</style>
