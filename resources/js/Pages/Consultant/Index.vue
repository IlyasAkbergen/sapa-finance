<template>
  <main-layout>
    <template #actions>
      <div class="actions">
        <a class="actions__link actions__link--green"
           :href="route('consultants-crud.create')">
          <span>Добавить консультанта</span>
        </a>
      </div>
    </template>

    <template #header>
      Консультанты на сайте
    </template>

    <div class="main__content__sellings-wrapper">
      <div class="main__content__consultants-flex">
        <ConsultantCard v-for="consultant in consultants"
              :consultant="consultant"
              :key="consultant.id"
              @delete="() => deleteClicked(consultant.id)"
        />
      </div>
      <Pagination :prev_page_url="data.prev_page_url"
                  :next-page-url="data.next_page_url"
                  :current_page="data.current_page"
                  :links="data.links"
      />
    </div>

    <DeleteAcceptModal :show="deleteAcceptModalShow"
                       @close="cancelDelete"
                       @accepted="deleteConsultant"/>
  </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import Pagination from "@/Shared/Pagination";

export default {
  name: "Index",
  components: {
    MainLayout,
    Pagination,
    ConsultantCard: () => import('./Card'),
		DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal')
  },
  props: {
  	data: Object
  },
	data(){
		return {
			itemToBeDeleted: null,
			deleteAcceptModalShow: false
		}
	},
  computed: {
  	consultants() {
  		return this.data.data;
    }
  },
  methods: {
		deleteClicked(id) {
			this.itemToBeDeleted = id;
			this.deleteAcceptModalShow = true
		},
		deleteConsultant() {
			this.$inertia.delete(route('consultants-crud.destroy', this.itemToBeDeleted));
		},
		cancelDelete() {
			this.deleteAcceptModalShow = false
			this.itemToBeDeleted = null
		}
  }
}
</script>
