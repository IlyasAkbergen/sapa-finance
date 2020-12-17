<template>
    <main-layout>
        <template #header>
            Курсы
        </template>

        <template #actions>
            <div class="actions">
                <search-bar
                    :value="search_key"
                    @input="input => search_key = input"
                />

                <a class="actions__link actions__link--blue d-flex"
                   :href="route('courses-stats')">
                    <StatsIcon />
                    Что больше продается
                </a>

                <a class="actions__link actions__link--green"
                   :href="route('courses-crud.create')">
                    <span>Добавить курс</span>
                </a>
            </div>
        </template>

        <div class="main__content__sellings-wrapper">
            <div class="users mb-3">
                <CrudTable :rows="filteredRows"
                           :headers="columns"
                           :delete_route_name="'courses-crud.destroy'"
                           :edit_route_name="'courses-crud.edit'"
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
            title: "Название курса",
            key: "title",
            is_title: true
          },
          {
            title: "Цена без обратной связи",
            key: "price_without_feedback",
          },
          {
            title: "Цена с обратной связью",
            key: "price_with_feedback",
          },
          {
            title: "Онлайн",
            key: "is_online",
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
