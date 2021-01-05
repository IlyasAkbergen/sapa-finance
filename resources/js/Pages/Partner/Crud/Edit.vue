<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="route('partners-crud.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Профиль компании {{ partner.name }}
        </template>

        <div class="ptef">
            <Form :form="form"
                  :partner="partner"
                  @submit="updatePartner" />
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
        partner: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                ...this.partner,
                ...{
                    password: null,
                    '_method': 'POST',
                }
            }, {
                bag: 'partnerForm',
                resetOnSuccess: true,
            }),
        }
    },
    methods: {
        updatePartner() {
            if (this.$refs.image) {
                this.$set(this.form, 'image', this.$refs.image.files[0]);
            }
            this.form.post('/partner-cabinet/update');
        }
    },
}
</script>
