<template>
  <main-layout>
<!--    <template #back-link>-->
<!--      <inertia-link :href="route('briefcases-admin.index')"-->
<!--                    class="navbar-brand mb-0 pb-0">-->
<!--        <img src="../../../img/back-arrow.png">-->
<!--      </inertia-link>-->
<!--    </template>-->

    <template #header>
      Просмотр {{ briefcase.title }}
      <inertia-link v-if="isAdmin"
                      :href="route('briefcases-admin.edit', briefcase.id)">
        <div class="btn btn-warning ml-2">
          Редактировать
        </div>
      </inertia-link>
    </template>

    <div class="main__content__program-card">
      <img :src="imagePath" class="main__content__program-card__img" alt="">
      <p class="main__content__program-card__title">
        {{ briefcase.title }}
      </p>
      <p class="main__content__program-card__text">
        {{ briefcase.description }}
      </p>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from "@/Layouts/MainLayout";
  import HasUser from "@/Mixins/HasUser";
  import Pencil from "@/assets/icons/Pencil";

  export default {
    name: "BriefcaseDetail",
    components: {
      MainLayout,
      Pencil,
    },
    mixins: [HasUser],
    props: {
      briefcase: Object,
    },
    computed: {
      imagePath() {
        return this.briefcase.image_path
          ? this.briefcase.image_path
          : 'images/course-card-img.png';
      },
    }
  }
</script>

<style scoped>

</style>
