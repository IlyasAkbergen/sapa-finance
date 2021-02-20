<template>
    <main-layout>
        <template #header>
            Курсы
        </template>

        <div class="main__content__courses-flex main__content__agent-my-courses-flex">
            <CourseCard v-for="course in courses"
                :course="course"
                :bought="course.bought"
                :key="course.id" />
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from '@/Layouts/MainLayout'
    export default {
        components: {
            MainLayout,
            CourseCard: () => import('../../Shared/CourseCard')
        },
        props: ['courses']
    }
</script>
