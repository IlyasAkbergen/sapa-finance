<template>
    <main-layout>
        <template #header>
            Партнеры
        </template>

        <template #actions>
            <div class="actions">
                <search-bar
                    :value="search_key"
                    @input="input => search_key = input"
                />

                <a class="actions__link actions__link--green"
                   :href="route('partners-crud.create')">
                    <span>Добавить партнера</span>
                </a>
            </div>
        </template>

        <div class="main__content__sellings-wrapper">
            <div class="partners mb-3">
                <CrudTable :rows="filteredRows"
                           :headers="columns"
                           :delete_route_name="'partners-crud.destroy'"
                           :edit_route_name="'partners-crud.edit'"
                           :show_route_name="'partners-crud.show'"
                />
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
import MainLayout from '@/Layouts/MainLayout'
export default {
    name: "Index",
    components: {
        MainLayout,
        SearchBar: () => import('@/Shared/SearchBar'),
        CrudTable: () => import('@/Shared/CrudTable'),
        Pagination: () => import('@/Shared/Pagination'),
        StatsIcon: () => import('@/assets/icons/Stats')
    },
    props: {
      data: Object,
    },
    data() {
      return {
        columns: [
          {
            title: "Название компании",
            key: "name",
            is_title: true
          },
          {
            title: "БИН",
            key: "bin",
          },
          {
            title: "Почти",
            key: "email",
          },
          {
            title: "Телефон",
            key: "phone",
          }
        ],
        search_key: ""
      }
    },
    computed: {
      filteredRows() {
        return this.search_key != null && this.search_key != ""
          ? this.data.data.filter((r) => r.name.toLowerCase()
                .indexOf(
                    this.search_key.toLowerCase()
                ) > -1)
          : this.data.data;
      }
    }
  }
</script>
