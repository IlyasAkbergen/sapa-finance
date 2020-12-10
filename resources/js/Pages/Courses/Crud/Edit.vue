<template>
    <main-layout>
        <template #back-link>
            <a :href="route('courses-crud.index')"
               class="navbar-brand mb-0">
                <img src="../../../../img/back-arrow.png" alt="">
            </a>
        </template>

        <template #header>
            Редактирование курса {{ course.title }}
        </template>

        <div class="cec">
            <Form :form="form"
                  @submit="updateCourse"/>
        </div>
    </main-layout>
</template>

<script>
export default {
    name: "Edit",
    components: {
        Form: () => import('./Form'),
        MainLayout: () => import('@/Layouts/MainLayout')
    },
    props: {
        course: Object
    },
    data() {
        return {
            form: this.$inertia.form({...this.course}, {
                bag: 'courseForm',
                resetOnSuccess: false,
            })
        }
    },
    methods: {
        updateCourse() {
            this.form.put(route('courses-crud.update', this.course), {
                preserveScroll: false
            })
        }
    }
}
</script>
