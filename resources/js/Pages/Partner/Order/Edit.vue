<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('partner-users.briefcases')"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Договор {{ order.contract_number }}
    </template>

    <div class="ptef">
      <Form :form="form"
            @submit="updateOrder" />
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
			order: Object,
		},
		data() {
			return {
				form: this.$inertia.form({
					...this.order,
					...{
						'_method': 'POST',
					}
				}, {
					bag: 'orderForm',
					resetOnSuccess: true,
				}),
			}
		},
		methods: {
			updateOrder() {
				this.form.post('/partner-user-order/update');
			}
		},
	}
</script>
