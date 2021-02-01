<template>
    <main-layout>
        <template #header>
            Редактирование информации об агентах
        </template>

        <div class="cec">
            <Form :form="form"
                  :course="agent_info"
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
        agent_info: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                ...this.agent_info,
                ...{
                    image: null,
                    '_method': 'PUT',
                }
            }, {
                bag: 'courseForm',
                resetOnSuccess: true,
            }),
        }
    },
    methods: {
        updateCourse() {
            this.form.post('/courses-crud/' + this.agent_info.id);
        },
    }
}
</script>
