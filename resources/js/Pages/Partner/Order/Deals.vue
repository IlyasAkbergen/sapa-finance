<template>
  <main-layout>
    <template #header>
      Заявки
    </template>
    <div class="main__content__sellings-wrapper">
      <div class="osk mb-3">
        <Item
            v-for="order in orders"
            :order="order" />
      </div>
      <Pagination :prev_page_url="data.prev_page_url"
                  :next_page_url="data.next_page_url"
                  :current_page="data.current_page"
                  :links="data.links"
      />
    </div>
  </main-layout>
</template>

<script>
	import MainLayout from "@/Layouts/MainLayout";
	import Pagination from "@/Shared/Pagination";
	export default {
		name: "Deals",
		components: {
			MainLayout,
			Pagination,
			Item: () => import('./OrderItem')
		},
		props: {
			data: Object,
			orders: Array
		}
	}
</script>
