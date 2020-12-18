<template>
  <main-layout>
    <template #header>
      Портфели
    </template>

    <template #actions>
      <div class="actions">
        <search-bar
                :value="search_key"
                @input="input => search_key = input"
        />

        <a class="actions__link actions__link--green"
           :href="route('briefcases-admin.create')">
          <span>Добавить портфель</span>
        </a>
      </div>
    </template>

    <div class="main__content__sellings-wrapper">
      <div class="users mb-3">
        <CrudTable :rows="filteredRows"
                   :headers="columns"
                   :delete_route_name="'briefcases-admin.destroy'"
                   :edit_route_name="'briefcases-admin.edit'"
        />
      </div>

      <Pagination :prev_page_url="data.prev_page_url"
                  :next-page-url="data.next_page_url"
                  :current_page="data.current_page"
                  :links="data.links"
      />
    </div>

  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  export default {
    name: "Index",
    components: {
      MainLayout,
      SearchBar: () => import('@/Shared/SearchBar'),
      CrudTable: () => import('@/Shared/CrudTable'),
      Pagination: () => import('@/Shared/Pagination')
    },
    props: {
      data: Object,
    },
    data() {
      return {
        columns: [
          {
            title: "Название",
            key: "title",
            is_title: true
          },
          {
            title: "Тип",
            key: "type_name",
          },
          {
            title: "Общая сумма договора",
            key: "sum",
          },
          {
            title: "Доходность",
            key: "profit",
          },
          {
            title: "Срок накопления",
            key: "duration",
          },
          {
            title: "Ежемесячный взнос",
            key: "monthly_payment",
          },
          {
            title: "Комиссия агента",
            key: "direct_fee"
          },
          {
            title: "Вознаграждается единицами",
            key: "awardable",
          }
        ],
        search_key: ""
      }
    },
    computed: {
      filteredRows() {
        return this.search_key != null && this.search_key != ""
          ? this.data.data.filter((r) => r.title.indexOf(this.search_key) > -1)
          : this.data.data;
      }
    }
  }
</script>
