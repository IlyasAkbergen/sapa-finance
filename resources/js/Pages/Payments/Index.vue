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
              <th>Клиент</th>
              <th>Сумма</th>
              <th>Примечание</th>
              <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="payment in payments" :key="payment.id">
              <th scope="row">
                <inertia-link v-if="payment.purchasable"
                              :href="payment.purchasable.link">
                  {{ payment.purchasable.title }}
                </inertia-link>
                <span v-else>Удалено</span>
              </th>
              <td v-if="payment.user">
                <inertia-link :href="route('users.show', payment.user.id)">
                  {{ payment.user.name }}
                </inertia-link>
              </td>
              <td>
                {{ payment.sum }} ₸
              </td>
              <td>{{ payment.note }}</td>
              <td>{{ payment.paid_at }}</td>
              <td class="text-center" v-if="isAdmin">
                <a class="payments__link payments__link--red clickable"
                   href="#"
                  @click.prevent="() => alertAcceptDelete(payment.id)">
                  Отменить оплату
                </a>
              </td>
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
    <DeleteAcceptModal :show="deleteAcceptModalShow"
                       @close="deleteAcceptModalShow = false; itemToBeDeleted = null"
                       @accepted="deleteRow"/>
  </main-layout>
</template>

<script>
import HasUser from "@/Mixins/HasUser";

export default {
  name: "Index",
  mixins: [HasUser],
  components: {
    MainLayout: () => import('@/Layouts/MainLayout'),
    Pagination: () => import('@/Shared/Pagination'),
    DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal')
  },
  props: {
    data: Object,
    payments: Array
  },
  data() {
    return {
      deleteAcceptModalShow: false,
      itemToBeDeleted: null
    }
  },
  methods: {
    alertAcceptDelete(id) {
      this.itemToBeDeleted = id
      this.deleteAcceptModalShow = true
    },
    deleteRow() {
      this.$inertia.post(route('deletePayment', this.itemToBeDeleted), {'_method': 'DELETE'})
        .then(() => {
          this.itemToBeDeleted = null;
          this.deleteAcceptModalShow = false;
        });
    }
  }
}
</script>
