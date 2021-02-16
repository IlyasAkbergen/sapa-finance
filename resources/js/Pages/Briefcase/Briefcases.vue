<template>
  <main-layout>
    <template #header>
      Портфели
    </template>
    <ul class="main__content__agent-portfels-nav">
      <li class="main__content__portfels-nav__item"
          :class="showType == 1 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 1"
           class="main__content__portfels-nav__link">
          Накопительные
        </a>
      </li>
      <li class="main__content__portfels-nav__item"
          :class="showType == 2 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 2"
           class="main__content__portfels-nav__link">
          Разовые
        </a>
      </li>
    </ul>
    <div class="main__content__agent-portfels-flex"
         v-show="showType == 1">
      <BriefcaseCard v-for="briefcase in cumulatives"
                     :briefcase="briefcase"
                     @showReferrers="showReferrers = true"
                     :key="briefcase.id"/>
    </div>
    <div class="main__content__agent-portfels-flex"
         v-show="showType == 2">
      <BriefcaseCard v-for="briefcase in oneTimes"
                     :briefcase="briefcase"
                     @showReferrers="showReferrers = true"
                     :key="briefcase.id"/>
    </div>

    <div class="main__content__agent-program-success">
      <div class="main__content__program-success__left">
        <img src="" alt="">
      </div>
      <div class="main__content__program-success__right">
        <i class="fas fa-times fa-sm" aria-hidden="true"></i>
        <p class="main__content__program-success__right__title">
          Запрос успешно отправлен
        </p>
        <p class="main__content__program-success__right__text">
          Ожидайте ответа модератора
        </p>
      </div>
    </div>

    <Modal :show="showReferrers"
           :closeable="true"
           @close="showReferrers = false"
    >
      <div class="modal-body" v-if="consultants && consultants.length > 0">
        <p class="page__program-modal__body__title">
          Прежде чем добавить накопительную программу выберите фининсового консультанта
        </p>
        <VueSlickCarousel v-bind="sliderSettings">
          <div v-for="consultant in consultants" class="mx-2">
            <a href="#" @click.prevent="() => setReferrer(consultant.id)">
              <img class="avatar__img"
                   :src="consultant.profile_photo_path
                      ? consultant.profile_photo_path
                      : '/images/consultant-avatar.png'"
              >
              <p class="main__content__news-flex__card__title">
                {{ consultant.name }}
              </p>
            </a>
          </div>
        </VueSlickCarousel>
      </div>
    </Modal>

  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import BriefcaseCard from '@/Shared/BriefcaseCard';
  import VueSlickCarousel from 'vue-slick-carousel'
  import HasUser from "@/Mixins/HasUser";

  export default {
    name: 'Briefcases',
    mixins: [HasUser],
    props: {
      briefcases: Array,
      consultants: Array
    },
    data() {
      return {
        showType: 1,
        showReferrers: false,
        sliderSettings: {
          swipeToSlide: true,
          "arrows": true,
          "dots": true,
          "infinite": true,
          "centerMode": true,
          "centerPadding": "20px",
          "slidesToShow": 1,
          "slidesToScroll": 1,
          "variableWidth": true
        }
      }
    },
    components: {
      MainLayout,
      BriefcaseCard,
      Modal: () => import('@/Jetstream/Modal'),
      VueSlickCarousel
    },
    computed: {
      cumulatives() {
        return this.briefcases.filter(b => b.type_id == 1);
      },
      oneTimes() {
        return this.briefcases.filter(b => b.type_id == 2);
      }
    },
    methods: {
      setReferrer(id) {
        this.$inertia.post(route('user-referrer-change'), {
          child_id: this.getUser().id,
          parent_id: id
        }).then(() => this.showReferrers = false)
      }
    }
  }
</script>
