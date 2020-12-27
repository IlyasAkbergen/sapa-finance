<template>
  <main-layout>
    <template #header>
      ШФК
    </template>
    <div class="main__content__sellings-wrapper">
      <div class="osk mb-3">
        <Item
            v-for="homework in homeworks"
            :homework="homework" />
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
  name: "Index",
  components: {
    MainLayout,
    Pagination,
    Item: () => import('./Item')
  },
  props: {
  	data: Object
  },
  computed: {
  	homeworks() {
  		return this.data.data;
    }
  }
}
</script>
