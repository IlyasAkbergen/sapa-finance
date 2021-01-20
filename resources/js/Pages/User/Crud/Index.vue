<template>
    <main-layout>
        <template #header>
            Пользователи
        </template>

        <template #actions>
            <div class="actions">
                <search-bar
                    :value="search_key"
                    @input="input => search_key = input"
                />

                <inertia-link class="actions__link actions__link--green"
                   :href="createRouteName">
                    <span>Добавить пользователя</span>
                </inertia-link>
            </div>
        </template>

        <div class="main__content__sellings-wrapper">
            <div class="users mb-3">
                <CrudTable :rows="filteredRows"
                           :headers="columns"
                           :delete_route_name="deleteRouteName"
                           :edit_route_name="editRouteName"
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
import HasUser from "@/Mixins/HasUser";
export default {
    name: "Index",
    components: {
        MainLayout,
        SearchBar: () => import('@/Shared/SearchBar'),
        CrudTable: () => import('@/Shared/CrudTable'),
        Pagination: () => import('@/Shared/Pagination'),
        StatsIcon: () => import('@/assets/icons/Stats')
    },
    mixins: [HasUser],
    props: {
      data: Object,
      items: Array
    },
    data() {
      return {
        columns: [
          {
            title: "ФИО",
            key: "name",
            is_title: true
          },
          {
            title: "ИИН",
            key: "iin",
          },
          {
            title: "Почта",
            key: "email",
          },
          {
            title: "Телефон",
            key: "phone",
          },
          {
            title: "Роль",
            key: "role_name"
          }
        ],
        search_key: ""
      }
    },
    computed: {
      filteredRows() {
        return this.search_key != null && this.search_key != ""
          ? this.items.filter((r) => r.name.toLowerCase()
                .indexOf(
                    this.search_key.toLowerCase()
                ) > -1)
          : this.items;
      },
      createRouteName() {
          if (this.isAdmin) {
              return route('users-crud.create')
          } else if (this.isPartner) {
              return route('partner-users.create')
          } else {
              return route('/')
          }
      },
      deleteRouteName() {
          if (this.isAdmin) {
              return 'users-crud.destroy';
          } else {
              return null;
          }
      },
      editRouteName() {
          if (this.isAdmin) {
              return 'users-crud.edit'
          } else if (this.isPartner) {
              return 'users.show'
          } else {
              return null
          }
      }
    }
  }
</script>
