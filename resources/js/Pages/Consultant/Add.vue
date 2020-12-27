<template>
  <main-layout>
    <template #back-link>
      <a :href="route('consultants-crud.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../img/back-arrow.png">
      </a>
    </template>

    <template #header>
      Добавление консультанта
    </template>

    <Form
      :form="form"
      @submit="createConsultant"
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
  data() {
		return {
			photoPreview: null,
			form: this.$inertia.form({
				name: "",
				email: null,
				phone: null,
				iin: null,
				photoPath: null,
				image: null,
				password: '',
				direct_points: 0,
        referral_level_id: 2,
				team_points: 0,
        role_id: 2,
				'_method': 'POST',
			}, {
				bag: 'userForm',
				resetOnSuccess: false,
			})
		}
  },
  methods: {
  	createConsultant() {
			this.form.post('/consultants-crud');
    }
  }
}
</script>
