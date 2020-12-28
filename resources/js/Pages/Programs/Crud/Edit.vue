<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="route('briefcases-admin.index')"
                          class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Редактирование портфеля {{ briefcase.title }}
        </template>

        <div class="cec">
            <Form :form="form"
                  :course="briefcase"
                  @submit="updateBriefcase"/>
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";

    export default {
        name: "Edit",
        components: {
            Form: () => import('./Form'),
            MainLayout,
        },
        props: {
            briefcase: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    ...this.briefcase,
                    ...{
                        image: null,
                        '_method': 'PUT',
                    }
                }, {
                    bag: 'briefcaseForm',
                    resetOnSuccess: true,
                }),
            }
        },
        methods: {
            updateBriefcase() {
                this.form.post('/programs-crud/' + this.briefcase.id);
            },
        }
    }
</script>
