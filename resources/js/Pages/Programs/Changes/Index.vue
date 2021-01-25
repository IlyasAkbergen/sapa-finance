<template>
  <main-layout>
    <template #back-link v-if="isAdmin">
      <inertia-link :href="route('partners-crud.index')"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>
    <div class="wishes">
      <table class="table mb-2" v-for="item in data">
        <tbody>
        <tr>
          <th class="align-middle" scope="row">
            <p class="wishes__title">
              {{ item.briefcase.title }}
            </p>
            <p class="wishes__desc">Хочет <span :class="`wishes__desc--${actionClass(item.type_id)}`">
                {{ actionText(item.type_id) }}
              </span> накопительную программу “<b>{{ item.briefcase.title }}</b>”
            </p>
          </th>
          <td class="float-right">
            <a v-if="item.status === 2" class="wishes__confirmed" href="#">
              Подтверждено
            </a>
            <a v-if="item.status === 3" class="wishes__rejected" href="#">
              Отклонено
            </a>
            <inertia-link class="wishes__link wishes__link--sky"
                          v-if="item.status === 1"
                          :href="route('apply-briefcase-change', item.id)">
              Подтвердить
            </inertia-link>
            <inertia-link class="wishes__link wishes__link--red"
                          v-if="item.status === 1"
                          :href="route('reject-briefcase-change', item.id)">
              Отклонить
            </inertia-link>
            <inertia-link class="wishes__link wishes__link--blue"
               :href="route('briefcase-change.show', item.id)">
              Посмотреть
            </inertia-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <template #header>
      Личный Кабинет
    </template>
  </main-layout>
</template>

<script>
import HasUser from "@/Mixins/HasUser";

export default {
  name: "Index",
  components: {
    MainLayout: () => import('@/Layouts/MainLayout')
  },
  mixins: [HasUser],
  props: {
    data: Array
  },
  methods: {
    actionClass(type) {
      if (type == 1) {
        return 'green';
      } else if (type == 2) {
        return 'warning';
      } else if (type == 3) {
        return 'red';
      }
    },
    actionText(type) {
      if (type == 1) {
        return 'добавить';
      } else if (type == 2) {
        return 'изменить';
      } else if (type == 3) {
        return 'удалить';
      }
    }
  }
}
</script>

<style scoped>
  .wishes__desc--warning { /* facepalm */
    color: #ffc107 !important;
  }
</style>
