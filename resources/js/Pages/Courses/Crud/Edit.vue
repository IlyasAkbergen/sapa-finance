<template>
    <main-layout>
        <template #back-link>
            <a :href="route('courses-crud.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
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
import MainLayout from '@/Layouts/MainLayout'
export default {
    name: "Edit",
    components: {
        Form: () => import('./Form'),
        MainLayout,
    },
    props: {
        course: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                ...this.course,
                ...{
                    image: null,
                    '_method': 'PUT',
                }
            }, {
                bag: 'courseForm',
                resetOnSuccess: false,
            })
        }
    },
    created() {
        if (this.$page.flash.message) {
            this.flash(this.$page.flash.message, 'success');
        }
    },
    methods: {
        updateCourse() {
            this.form.post('/courses-crud/' + this.course.id);
        },
    }
}
</script>
