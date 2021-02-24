<template>
  <div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th scope="col"
            v-for="header in headers"
            :key="header.id">
          {{ header.title }}
        </th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="row in rows"
          class="clickable"
          @click.capture="() => rowClicked(row.id)"
          :key="row.id"
      >
        <th class="align-middle" scope="row">
          {{ row[headers[0].key] }}
        </th>
        <td class="align-middle"
            v-for="header in headers"
            v-if="!header.is_title">
          {{ row[header.key] }}
        </td>

        <td class="align-middle">
          <inertia-link class="users__link--sky float-right"
                        v-if="show_route_name"
                        :href="route(show_route_name, row.id)">
            Перейти
          </inertia-link>
          <a class="users__link users__link--red
                        float-right courses__delete"
             href="#"
             v-if="delete_route_name"
             @click.prevent="() => deleteClicked(row.id)">
            <Trash/>
          </a>
          <inertia-link class="users__link users__link--blue float-right"
                        v-if="edit_route_name"
                        :href="route(edit_route_name, row.id)">
            <Pencil/>
          </inertia-link>
        </td>
      </tr>
      </tbody>
    </table>
    <DeleteAcceptModal :show="deleteAcceptModalShow"
                       @close="cancelDelete"
                       @accepted="deleteItem"/>
  </div>
</template>

<script>
  export default {
    name: "CrudTable",
    components: {
      DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal'),
      Trash: () => import('@/assets/icons/Trash'),
      Pencil: () => import('@/assets/icons/Pencil'),
    },
    props: {
      headers: Array,
      rows: Array,
      edit_route_name: String,
      delete_route_name: String,
      show_route_name: String,
    },
    data() {
      return {
        deleteAcceptModalShow: false,
        itemToBeDeleted: null
      }
    },
    methods: {
      rowClicked(id) {
        if (this.edit_route_name) {
          this.$inertia.get(route(this.edit_route_name, id));
        }
      },
      deleteClicked(id) {
        this.itemToBeDeleted = id;
        this.deleteAcceptModalShow = true
      },
      deleteItem() {
        if (this.itemToBeDeleted) {
          this.$inertia.delete(route(this.delete_route_name, this.itemToBeDeleted));
        }
      },
      cancelDelete() {
        this.deleteAcceptModalShow = false
        this.itemToBeDeleted = null
      }
    }
  }
</script>
<style scoped>
  .clickable:hover {
    background-color: rgba(132,132,132, 0.12);
  }
</style>
