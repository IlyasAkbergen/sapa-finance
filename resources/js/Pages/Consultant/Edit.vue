<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('consultants-crud.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Изменение данных консультанта {{ consultant.name }}
    </template>

    <Form
        :form="form"
        @submit="updateConsultant"
    />
  </main-layout>
</template>

<script>
	import MainLayout from "@/Layouts/MainLayout";
	export default {
		name: "Add",
		components: {
			MainLayout,
			Form: () => import('./Form')
		},
    props: {
			consultant: Object
    },
    data() {
			return {
				photoPreview: null,
				form: this.$inertia.form({
          ...this.consultant,
          ...{
						image: null,
						'_method': 'PUT',
          }
				}, {
					bag: 'userForm',
					resetOnSuccess: false,
				})
      }
    },
		methods: {
			updateConsultant() {
				this.form.post('/consultants-crud/' + this.consultant.id);
			},
		}
	}
</script>
