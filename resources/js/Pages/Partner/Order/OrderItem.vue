<template>
  <div class="table-responsive">
    <table class="table">
      <tbody>
      <tr>
        <th class="align-middle" scope="row" v-if="order.contract_number">
          <inertia-link :href="route('partner-users-order.edit', order.id)">
            {{ order.contract_number }}
          </inertia-link>
        </th>
        <th class="align-middle" scope="row">
          <inertia-link :href="route('users.show', order.user.id)">
            {{ order.user.name }}
          </inertia-link>
        </th>
        <td class="align-middle">
          <inertia-link :href="route('programs-crud.show', order.briefcase.id)">
            {{ order.briefcase.title }}
          </inertia-link>
        </td>
        <td class="float-right">
          <a class="osk__action osk__action--sky"
             v-if="order.status === 1"
             @click.prevent="accept"
             href="#">
            Принять
          </a>
          <a class="osk__action osk__action--red"
             v-if="order.status === 1"
             @click.prevent="reject"
             href="#">
            Отказать
          </a>
        </td>

        <td class="float-right" v-if="order.contract_number">
          <inertia-link :href="route('partner-users-order.edit', order.id)"
            class="users__link users__link--blue float-right">
            <Pencil />
          </inertia-link>
        </td>

        <td class="float-right" v-if="order.status === 3">
          <a class="osk__status osk__status--red">Отказано</a>
        </td>

        <td class="float-right" v-if="order.status === 2">
          <a class="osk__status osk__status--sky">Принято</a>
        </td>

      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Pencil from "@/assets/icons/Pencil";
export default {
  name: "OrderItem",
  components: {
    Pencil
  },
  props: {
    order: Object
  },
  methods: {
    accept() {
      this.$inertia.put('/user-briefcase/accept/' + this.order.id)
    },
    reject() {
      this.$inertia.put('/user-briefcase/reject/' + this.order.id)
    }
  }
}
</script>
