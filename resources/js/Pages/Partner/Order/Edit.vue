<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('partner-users.deals')"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Договор {{ order.contract_number }}
      <a class="actions__link actions__link--green ml-2"
          href="#" @click.prevent="addPayment">
          <span>Добавить платеж</span>
      </a>
    </template>

    <div class="ptef">
      <Form :form="form"
            :users="users"
            :briefcases="briefcases"
            @submit="updateOrder" />
    </div>

    <Modal :show="showModal"
           :closeable="true"
           @close="showModal=false">
      <PaymentForm
        v-if="paymentForm"
        :form="paymentForm"
        @submit="paymentSubmit"
      />
    </Modal>
  </main-layout>
</template>

<script>
	import toast from '@/toast'
	import MainLayout from '@/Layouts/MainLayout'
	export default {
		name: "Edit",
		components: {
			Form: () => import('./Form'),
			MainLayout,
      Modal: () => import('@/Jetstream/Modal'),
      PaymentForm: () => import('@/Pages/Payments/Form')
		},
		props: {
			order: Object,
      briefcases: Array,
      users: Array
		},
    watch: {
      formSuccessfull(newValue) {
        if (newValue) {
					  toast.success("Платеж сохранен.")
            this.closeModal()
        }
      }
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
        showModal: false,
        paymentForm: null
			}
		},
    computed: {
		  formSuccessfull() {
		    return this.paymentForm && this.paymentForm.recentlySuccessful;
      }
    },
		methods: {
			updateOrder() {
				this.form.post('/partner-user-order/update');
			},
      addPayment() {
        this.paymentForm = this.$inertia.form({
          '_method': 'POST',
          sum: 0,
          user_id: this.order.user.id,
          order_id: this.order.id,
          paid_at: new Date().toLocaleDateString()
        }, {
          bag: 'paymentForm',
          resetOnSuccess: true,
        });

        this.showModal = true
      },
      closeModal() {
			  this.paymentForm = null;
			  this.showModal = false
      },
      paymentSubmit() {
			  this.paymentForm
          .post('/partner-user-payment');
      }
		},
	}
</script>
