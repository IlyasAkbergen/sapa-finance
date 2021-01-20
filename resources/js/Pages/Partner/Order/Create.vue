<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('partner-users.deals')"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Новый договор
    </template>

    <div class="ptef">
      <Form :form="form"
            :users="users"
            :briefcases="briefcases"
            @submit="createOrder" />
    </div>
  </main-layout>
</template>

<script>
	import MainLayout from '@/Layouts/MainLayout'
	export default {
		name: "Create",
		components: {
			Form: () => import('./Form'),
			MainLayout
		},
		props: {
			briefcases: Array,
			users: Array
		},
		data() {
			return {
				form: this.$inertia.form({
          user_id: null,
          briefcase_id: null,
					contract_number: null,
					duration: null,
					monthly_payment: 0,
					profit: 0,
					sum: null,
          created_at: null,
					'_method': 'POST',
				}, {
					bag: 'orderForm',
					resetOnSuccess: true,
				}),
				showModal: false,
				paymentForm: null
			}
		},
		methods: {
			createOrder() {
				this.form.post('/partner-user-order');
			}
		},
	}
</script>
