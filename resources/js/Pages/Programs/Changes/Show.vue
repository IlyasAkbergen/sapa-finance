<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="route('briefcase-change.index', {partner_id: partner.id})"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      {{ headerTitle }}
    </template>

    <div class="main__content__program-card">
      <p class="main__content__program-card__title">Текущее фото</p>
      <img :src="imagePath" class="main__content__program-card__img mt-2" alt="">

      <p class="main__content__program-card__title" v-if="newImagePath">Новое фото</p>
      <img v-if="newImagePath"
        :src="newImagePath"
        class="main__content__program-card__img mt-2" alt="">

      <p class="main__content__program-card__title">{{ briefcase.title }}</p>

      <p class="main__content__program-card__title text-warning"
        v-if="change.change_data && change.change_data.title">
        {{ change.change_data.title }}
      </p>

      <p class="main__content__program-card__text">
        {{ briefcase.description }}
      </p>

      <p class="main__content__program-card__text text-warning"
         v-if="change.change_data && change.change_data.description">
        {{ change.change_data.description }}
      </p>

      <a v-if="change.status === 2" class="wishes__confirmed" href="#">
        Подтверждено
      </a>
      <a v-if="change.status === 3" class="wishes__rejected" href="#">
        Отклонено
      </a>

      <inertia-link class="wishes__link wishes__link--sky"
                    v-if="change.status === 1"
                    :href="route('apply-briefcase-change', change.id)">
        Подтвердить
      </inertia-link>
      <inertia-link class="wishes__link wishes__link--red"
                    v-if="change.status === 1"
                    :href="route('reject-briefcase-change', change.id)">
        Отклонить
      </inertia-link>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from "@/Layouts/MainLayout";

  export default {
    name: "Show",
    components: {
      MainLayout,
    },
    props: {
      change: Object,
      briefcase: Object,
      partner: Object
    },
    computed: {
      imagePath() {
        return this.briefcase.image_path
          ? this.briefcase.image_path
          : 'images/course-card-img.png';
      },
      newImagePath() {
        return this.change?.change_data?.image_path;
      },
      headerTitle() {
        if (this.change.type_id == 1) {
          return 'Добавление программы';
        } else if (this.change.type_id == 2) {
          return 'Изменения в программе';
        } else if (this.change.type_id == 3) {
          return 'Удаление программы';
        }
      }
    }
  }
</script>

<style scoped>

</style>
