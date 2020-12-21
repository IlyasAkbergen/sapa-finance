<template>
    <main-layout>
        <template #back-link>
            <a :href="route('partners-crud.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </a>
        </template>

        <template #header>
            Добавление партнера
        </template>

        <div class="ptef">
            <Form :form="form"
                  @submit="createPartner"/>
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
    data() {
      return {
        form: this.$inertia.form({
            name: "",
            email: null,
            phone: null,
            bin: null,
            password: '',
            '_method': 'POST',
        }, {
            bag: 'partnerForm',
            resetOnSuccess: false,
        })
      }
    },
    methods: {
        createPartner() {
            this.form.post('/partners-crud');
        },
    }
}
</script>
