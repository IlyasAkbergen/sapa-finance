<template>
    <main-layout>
        <template #back-link>
            <a :href="route('partners-crud.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </a>
        </template>

        <template #header>
            Оставить отзыв
        </template>

        <div class="ptef">
            <Form :form="form"
                  @submit="createComplaint"/>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
export default {
    name: "Add",
    components: {
      Form: () => import('./Form'),
      MainLayout
    },
    props: {
        from_id: Number,
        to_id: Number,
    },
    data() {
      return {
        form: this.$inertia.form({
            content: '',
            from_id: this.from_id,
            to_id: this.to_id,
            '_method': 'POST',
        }, {
            bag: 'complaintForm',
            resetOnSuccess: false,
        })
      }
    },
    methods: {
        createComplaint() {
            this.form.post('/complaints-crud');
        },
    }
}
</script>
