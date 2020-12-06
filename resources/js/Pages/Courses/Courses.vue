<template>
    <main-layout>
        <template #header>
            Курсы
        </template>
        <div class="page">
            <div class="main">
                <div class="main__content">
                    <div class="main__content__courses-flex">
                        <CourseCard v-for="course in courses"
                            :course="course"
                            :key="course.id" />
                    </div>
                </div>
            </div>
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