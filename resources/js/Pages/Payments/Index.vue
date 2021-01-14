<template>
  <main-layout>
    <template #header>
      Платежи
    </template>
    <div class="main__content__sellings-wrapper">
      <div class="main__content__sellings-wrapper__sellings">
        <div class="main__content__sellings-wrapper__sellings__table">
          <table class="table">
            <thead>
            <tr>
              <th>Что оплатил</th>
              <th>Сумма</th>
              <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="payment in payments">
              <th scope="row">
                <inertia-link :href="payment.purchasable.link">
                  {{ payment.purchasable.title }}
                </inertia-link>
              </th>
              <td>
                {{ payment.sum }} ₸
              </td>
              <td>{{ payment.paid_at }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <Pagination
              :prev_page_url="data.prev_page_url"
              :next_page_url="data.next_page_url"
              :current_page="data.current_page"
              :links="data.links"/>
      <div class="clear"></div>
    </div>
  </main-layout>
</template>

<script>
	export default {
		name: "Index",
    components: {
			MainLayout: () => import('@/Layouts/MainLayout'),
			Pagination: () => import('@/Shared/Pagination')
    },
    props: {
			data: Object,
      payments: Array
    },
	}
</script>
